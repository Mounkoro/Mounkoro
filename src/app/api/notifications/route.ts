import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { verifyToken } from "@/lib/auth";

export async function GET(request: Request) {
  const token = request.headers.get("cookie")?.split("; ").find(c => c.startsWith("token="))?.split("=")[1];
  if (!token) return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  const payload = await verifyToken(token);
  if (!payload || payload.role !== "ENGINEER") return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  try {
    const tenMinutesAgo = new Date(Date.now() - 10 * 60 * 1000);

    const newRequests = await prisma.request.findMany({
      where: {
        status: "PENDING",
        createdAt: {
          gt: tenMinutesAgo
        }
      },
      orderBy: {
        createdAt: 'desc'
      },
      include: {
        client: {
          include: {
            user: true
          }
        }
      }
    });

    return NextResponse.json(newRequests);
  } catch (error) {
    return NextResponse.json({ error: "Erreur serveur" }, { status: 500 });
  }
}
