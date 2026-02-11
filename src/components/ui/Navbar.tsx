"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { motion } from "framer-motion";
import { Zap, User, LogOut, Menu } from "lucide-react";
import { Button } from "./Button";
import { cn } from "@/lib/utils";

export function Navbar() {
  const pathname = usePathname();

  return (
    <nav className="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          <Link href="/" className="flex items-center space-x-2">
            <Zap className="h-8 w-8 text-primary" />
            <span className="text-xl font-bold text-gray-900">POINT ELECTRIC</span>
          </Link>

          <div className="hidden md:flex items-center space-x-8">
            <Link
              href="/"
              className={cn("text-sm font-medium transition-colors",
                pathname === "/" ? "text-primary" : "text-gray-600 hover:text-primary")}
            >
              Accueil
            </Link>
            <Link
              href="/login"
              className="text-sm font-medium text-gray-600 hover:text-primary transition-colors"
            >
              Connexion
            </Link>
            <Link href="/register">
              <Button size="sm">S'inscrire</Button>
            </Link>
          </div>

          <div className="md:hidden">
            <Button variant="secondary" size="sm">
              <Menu className="h-5 w-5" />
            </Button>
          </div>
        </div>
      </div>
    </nav>
  );
}
