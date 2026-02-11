"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { Card } from "@/components/ui/Card";
import { Input } from "@/components/ui/Input";
import { Button } from "@/components/ui/Button";
import { MapPin, Upload, Zap, AlertCircle } from "lucide-react";

export default function NewRequestPage() {
  const [formData, setFormData] = useState({
    type: "QUOTE",
    description: "",
    location: "",
  });
  const [loading, setLoading] = useState(false);
  const [geoLoading, setGeoLoading] = useState(false);
  const router = useRouter();

  const handleGetLocation = () => {
    setGeoLoading(true);
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition((position) => {
        setFormData({
          ...formData,
          location: `${position.coords.latitude}, ${position.coords.longitude}`,
        });
        setGeoLoading(false);
      }, (error) => {
        alert("Erreur de géolocalisation: " + error.message);
        setGeoLoading(false);
      });
    } else {
      alert("La géolocalisation n'est pas supportée par votre navigateur.");
      setGeoLoading(false);
    }
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);

    try {
      const res = await fetch("/api/requests", {
        method: "POST",
        body: JSON.stringify(formData),
      });

      if (res.ok) {
        router.push("/client/dashboard");
      } else {
        alert("Erreur lors de la création de la demande");
      }
    } catch (err) {
      alert("Erreur réseau");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="max-w-3xl mx-auto px-4 py-12">
      <Card className="space-y-8">
        <div>
          <h1 className="text-3xl font-bold">Nouvelle Demande</h1>
          <p className="text-gray-600">Décrivez votre besoin pour recevoir des propositions.</p>
        </div>

        <form onSubmit={handleSubmit} className="space-y-6">
          <div className="space-y-2">
            <label className="text-sm font-medium text-gray-700">Type d'intervention</label>
            <select
              className="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary outline-none"
              value={formData.type}
              onChange={(e) => setFormData({...formData, type: e.target.value})}
            >
              <option value="QUOTE">Devis Standard</option>
              <option value="EMERGENCY">Dépannage d'Urgence</option>
              <option value="INSTALLATION">Nouvelle Installation</option>
            </select>
          </div>

          <div className="space-y-2">
            <label className="text-sm font-medium text-gray-700">Description</label>
            <textarea
              className="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary outline-none min-h-[120px]"
              placeholder="Expliquez votre problème ou votre projet..."
              value={formData.description}
              onChange={(e) => setFormData({...formData, description: e.target.value})}
              required
            />
          </div>

          <div className="space-y-2">
            <label className="text-sm font-medium text-gray-700">Localisation</label>
            <div className="flex gap-2">
              <Input
                placeholder="Adresse ou coordonnées"
                value={formData.location}
                onChange={(e) => setFormData({...formData, location: e.target.value})}
                required
              />
              <Button type="button" variant="outline" onClick={handleGetLocation} disabled={geoLoading}>
                <MapPin className={`h-4 w-4 ${geoLoading ? "animate-bounce" : ""}`} />
              </Button>
            </div>
          </div>

          <div className="space-y-2">
            <label className="text-sm font-medium text-gray-700">Documents / Photos (Optionnel)</label>
            <div className="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-primary transition-colors cursor-pointer">
              <Upload className="h-8 w-8 text-gray-400 mx-auto mb-2" />
              <p className="text-sm text-gray-500">Cliquez ou glissez des fichiers ici</p>
              <p className="text-xs text-gray-400 mt-1">PNG, JPG, PDF jusqu'à 10Mo</p>
            </div>
          </div>

          <Button className="w-full h-12 text-lg" type="submit" disabled={loading}>
            {loading ? "Envoi en cours..." : "Envoyer la demande"}
          </Button>
        </form>
      </Card>
    </div>
  );
}
