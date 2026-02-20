import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { verifyToken } from "@/lib/auth";
import { exec } from "child_process";
import { promisify } from "util";
import fs from "fs/promises";
import path from "path";

const execPromise = promisify(exec);

// Basic escaping for HTML
function escapeHtml(unsafe: string) {
  return unsafe
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

export async function POST(request: Request) {
  const token = request.headers.get("cookie")?.split("; ").find(c => c.startsWith("token="))?.split("=")[1];
  if (!token) return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  const payload = await verifyToken(token);
  if (!payload || payload.role !== "ENGINEER") return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  try {
    const { clientId, items, total } = await request.json();

    const client = await prisma.clientProfile.findUnique({ where: { id: clientId } });
    if (!client) return NextResponse.json({ error: "Client non trouvé" }, { status: 404 });

    const engineer = await prisma.engineerProfile.findUnique({ where: { userId: payload.userId } });
    if (!engineer) return NextResponse.json({ error: "Ingénieur non trouvé" }, { status: 404 });

    const invoice = await prisma.invoice.create({
      data: {
        clientId: client.id,
        engineerId: engineer.id,
        amount: total,
        items: JSON.stringify(items),
        status: "PENDING",
      },
    });

    const htmlContent = `
      <html>
        <head>
          <style>
            body { font-family: sans-serif; padding: 40px; color: #1a1a1a; }
            .header { border-bottom: 4px solid #00A8E8; padding-bottom: 20px; margin-bottom: 40px; }
            .title { color: #00A8E8; font-size: 32px; font-weight: bold; }
            .details { margin-bottom: 30px; }
            table { width: 100%; border-collapse: collapse; }
            th { text-align: left; border-bottom: 2px solid #8B5E3C; padding: 10px; }
            td { padding: 10px; border-bottom: 1px solid #eee; }
            .total { font-size: 24px; font-weight: bold; color: #00A8E8; text-align: right; margin-top: 30px; }
          </style>
        </head>
        <body>
          <div className="header">
            <div className="title">POINT ELECTRIC</div>
            <p>Facture N° ${invoice.id}</p>
          </div>
          <div className="details">
            <p><strong>Client ID:</strong> ${escapeHtml(clientId)}</p>
            <p><strong>Date:</strong> ${new Date().toLocaleDateString('fr-FR')}</p>
          </div>
          <table>
            <thead>
              <tr>
                <th>Description</th>
                <th>Prix</th>
              </tr>
            </thead>
            <tbody>
              ${items.map((item: any) => `
                <tr>
                  <td>${escapeHtml(item.description)}</td>
                  <td>${Number(item.price).toFixed(2)} €</td>
                </tr>
              `).join('')}
            </tbody>
          </table>
          <div className="total">TOTAL : ${total.toFixed(2)} €</div>
        </body>
      </html>
    `;

    const tempHtmlPath = path.join("/tmp", `invoice-${invoice.id}.html`);
    const tempPdfPath = path.join("/tmp", `invoice-${invoice.id}.pdf`);

    await fs.writeFile(tempHtmlPath, htmlContent);
    await execPromise(`weasyprint ${tempHtmlPath} ${tempPdfPath}`);
    const pdfBuffer = await fs.readFile(tempPdfPath);

    await fs.unlink(tempHtmlPath);
    await fs.unlink(tempPdfPath);

    return new NextResponse(pdfBuffer, {
      headers: {
        "Content-Type": "application/pdf",
        "Content-Disposition": `attachment; filename="facture-point-electric-${invoice.id}.pdf"`,
      },
    });
  } catch (error) {
    console.error("PDF generation error:", error);
    return NextResponse.json({ error: "Erreur lors de la génération du PDF" }, { status: 500 });
  }
}
