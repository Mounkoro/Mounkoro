import { NextResponse } from "next/server";
import type { NextRequest } from "next/server";
import { verifyToken } from "@/lib/auth";

export async function middleware(request: NextRequest) {
  const token = request.cookies.get("token")?.value;
  const { pathname } = request.nextUrl;

  // Public API routes
  if (pathname.startsWith("/api/auth")) {
    return NextResponse.next();
  }

  // Protected routes
  if (pathname.startsWith("/client") || pathname.startsWith("/engineer")) {
    if (!token) {
      return NextResponse.redirect(new URL("/login", request.url));
    }

    const payload = await verifyToken(token);
    if (!payload) {
      return NextResponse.redirect(new URL("/login", request.url));
    }

    if (pathname.startsWith("/client") && payload.role !== "CLIENT") {
      return NextResponse.redirect(new URL("/engineer/dashboard", request.url));
    }

    if (pathname.startsWith("/engineer") && payload.role !== "ENGINEER") {
      return NextResponse.redirect(new URL("/client/dashboard", request.url));
    }
  }

  return NextResponse.next();
}

export const config = {
  matcher: ["/client/:path*", "/engineer/:path*"],
};
