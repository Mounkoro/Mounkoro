import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { verifyToken } from "@/lib/auth";

export async function POST(request: Request) {
  const token = request.headers.get("cookie")?.split("; ").find(c => c.startsWith("token="))?.split("=")[1];
  if (!token) return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  const payload = await verifyToken(token);
  if (!payload || payload.role !== "CLIENT") return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  try {
    const { type, description, location } = await request.json();

    const client = await prisma.clientProfile.findUnique({ where: { userId: payload.userId } });
    if (!client) return NextResponse.json({ error: "Client non trouvé" }, { status: 404 });

    const newRequest = await prisma.request.create({
      data: {
        clientId: client.id,
        type,
        description,
        location,
      },
    });

    return NextResponse.json(newRequest, { status: 201 });
  } catch (error) {
    return NextResponse.json({ error: "Erreur serveur interne" }, { status: 500 });
  }
}
