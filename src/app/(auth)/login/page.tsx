"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { Card } from "@/components/ui/Card";
import { Input } from "@/components/ui/Input";
import { Button } from "@/components/ui/Button";
import Link from "next/link";
import { Zap } from "lucide-react";

export default function LoginPage() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);
  const router = useRouter();

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError("");

    try {
      const res = await fetch("/api/auth/login", {
        method: "POST",
        body: JSON.stringify({ email, password }),
      });

      const data = await res.json();
      if (res.ok) {
        router.push(data.role === "CLIENT" ? "/client/dashboard" : "/engineer/dashboard");
      } else {
        setError(data.error);
      }
    } catch (err) {
      setError("Une erreur est survenue");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="flex items-center justify-center min-h-[80vh] px-4">
      <Card className="w-full max-w-md space-y-8 p-10">
        <div className="text-center">
          <Zap className="h-12 w-12 text-primary mx-auto" />
          <h2 className="mt-6 text-3xl font-bold text-gray-900">Connexion</h2>
          <p className="mt-2 text-sm text-gray-600">POINT ELECTRIC</p>
        </div>

        <form className="space-y-6" onSubmit={handleLogin}>
          {error && <p className="text-sm text-red-500 text-center">{error}</p>}
          <Input
            label="Email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
          <Input
            label="Mot de passe"
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />

          <Button className="w-full" type="submit" disabled={loading}>
            {loading ? "Chargement..." : "Se connecter"}
          </Button>
        </form>

        <p className="text-center text-sm text-gray-600">
          Pas de compte ?{" "}
          <Link href="/register" className="text-primary font-medium hover:underline">
            S'inscrire
          </Link>
        </p>
      </Card>
    </div>
  );
}
