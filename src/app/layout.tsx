import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import { Navbar } from "@/components/ui/Navbar";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "POINT ELECTRIC | Experts en Électricité",
  description: "Plateforme de mise en relation entre clients et ingénieurs électriciens.",
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="fr">
      <body className={inter.className}>
        <Navbar />
        <main className="pt-16 min-h-screen bg-secondary">
          {children}
        </main>
      </body>
    </html>
  );
}
