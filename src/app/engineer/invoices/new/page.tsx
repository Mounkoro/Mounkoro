"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { Card } from "@/components/ui/Card";
import { Input } from "@/components/ui/Input";
import { Button } from "@/components/ui/Button";
import { Plus, Trash, FileText, Euro } from "lucide-react";
import { formatPrice } from "@/lib/utils";

export default function NewInvoicePage() {
  const [items, setItems] = useState([{ description: "", price: 0 }]);
  const [clientId, setClientId] = useState("");
  const [loading, setLoading] = useState(false);
  const router = useRouter();

  const addItem = () => setItems([...items, { description: "", price: 0 }]);
  const removeItem = (index: number) => setItems(items.filter((_, i) => i !== index));

  const updateItem = (index: number, field: string, value: string | number) => {
    const newItems = [...items];
    (newItems[index] as any)[field] = value;
    setItems(newItems);
  };

  const total = items.reduce((sum, item) => sum + Number(item.price), 0);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    // API call would go here
    setTimeout(() => {
      alert("Facture générée avec succès (Simulation)");
      router.push("/engineer/dashboard");
      setLoading(false);
    }, 1500);
  };

  return (
    <div className="max-w-4xl mx-auto px-4 py-12">
      <Card className="space-y-8">
        <div className="flex items-center gap-4">
          <div className="bg-primary/10 p-3 rounded-full text-primary">
            <FileText className="h-6 w-6" />
          </div>
          <div>
            <h1 className="text-3xl font-bold">Créer une Facture</h1>
            <p className="text-gray-600">Générez une facture détaillée pour votre client.</p>
          </div>
        </div>

        <form onSubmit={handleSubmit} className="space-y-8">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <Input label="ID Client" placeholder="ex: cl001" value={clientId} onChange={(e) => setClientId(e.target.value)} required />
            <Input label="Date de l'intervention" type="date" required />
          </div>

          <div className="space-y-4">
            <h3 className="font-bold text-lg border-b pb-2">Matériel & Main d'œuvre</h3>
            {items.map((item, index) => (
              <div key={index} className="flex gap-4 items-end">
                <div className="flex-1">
                  <Input
                    label={index === 0 ? "Description" : ""}
                    placeholder="ex: Câble 2.5mm, Forfait horaire..."
                    value={item.description}
                    onChange={(e) => updateItem(index, "description", e.target.value)}
                    required
                  />
                </div>
                <div className="w-32">
                  <Input
                    label={index === 0 ? "Prix (€)" : ""}
                    type="number"
                    value={item.price}
                    onChange={(e) => updateItem(index, "price", parseFloat(e.target.value))}
                    required
                  />
                </div>
                {items.length > 1 && (
                  <Button type="button" variant="danger" size="sm" onClick={() => removeItem(index)} className="mb-1">
                    <Trash className="h-4 w-4" />
                  </Button>
                )}
              </div>
            ))}
            <Button type="button" variant="outline" size="sm" onClick={addItem} className="flex items-center gap-2">
              <Plus className="h-4 w-4" /> Ajouter un élément
            </Button>
          </div>

          <div className="bg-secondary p-6 rounded-xl flex justify-between items-center">
            <span className="text-xl font-bold">Total à payer :</span>
            <span className="text-3xl font-black text-primary">{formatPrice(total)}</span>
          </div>

          <div className="flex justify-end gap-4">
            <Button type="button" variant="secondary" onClick={() => router.back()}>Annuler</Button>
            <Button type="submit" disabled={loading} className="px-8">
              {loading ? "Génération..." : "Générer la Facture"}
            </Button>
          </div>
        </form>
      </Card>
    </div>
  );
}
