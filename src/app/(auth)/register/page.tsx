"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { Card } from "@/components/ui/Card";
import { Input } from "@/components/ui/Input";
import { Button } from "@/components/ui/Button";
import Link from "next/link";
import { Zap } from "lucide-react";

export default function RegisterPage() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    role: "CLIENT",
  });
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);
  const router = useRouter();

  const handleRegister = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError("");

    try {
      const res = await fetch("/api/auth/register", {
        method: "POST",
        body: JSON.stringify(formData),
      });

      if (res.ok) {
        router.push("/login");
      } else {
        const data = await res.json();
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
          <h2 className="mt-6 text-3xl font-bold text-gray-900">Inscription</h2>
        </div>

        <form className="space-y-6" onSubmit={handleRegister}>
          {error && <p className="text-sm text-red-500 text-center">{error}</p>}
          <Input
            label="Nom complet"
            value={formData.name}
            onChange={(e) => setFormData({...formData, name: e.target.value})}
            required
          />
          <Input
            label="Email"
            type="email"
            value={formData.email}
            onChange={(e) => setFormData({...formData, email: e.target.value})}
            required
          />
          <Input
            label="Mot de passe"
            type="password"
            value={formData.password}
            onChange={(e) => setFormData({...formData, password: e.target.value})}
            required
          />

          <div className="space-y-2">
            <label className="text-sm font-medium text-gray-700">Vous êtes :</label>
            <div className="flex gap-4">
              <label className="flex items-center space-x-2">
                <input
                  type="radio"
                  value="CLIENT"
                  checked={formData.role === "CLIENT"}
                  onChange={(e) => setFormData({...formData, role: e.target.value})}
                />
                <span>Client</span>
              </label>
              <label className="flex items-center space-x-2">
                <input
                  type="radio"
                  value="ENGINEER"
                  checked={formData.role === "ENGINEER"}
                  onChange={(e) => setFormData({...formData, role: e.target.value})}
                />
                <span>Ingénieur</span>
              </label>
            </div>
          </div>

          <Button className="w-full" type="submit" disabled={loading}>
            {loading ? "Création..." : "S'inscrire"}
          </Button>
        </form>

        <p className="text-center text-sm text-gray-600">
          Déjà un compte ?{" "}
          <Link href="/login" className="text-primary font-medium hover:underline">
            Se connecter
          </Link>
        </p>
      </Card>
    </div>
  );
}
