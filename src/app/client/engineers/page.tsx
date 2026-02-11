"use client";

import { useState } from "react";
import { Card } from "@/components/ui/Card";
import { Button } from "@/components/ui/Button";
import { Input } from "@/components/ui/Input";
import { Search, Star, MapPin, Zap } from "lucide-react";

const ENGINEERS = [
  {
    id: "1",
    name: "Thomas Élec",
    specialty: "Domotique & Installation",
    rating: 4.9,
    reviews: 124,
    location: "Paris, France",
    available: true,
  },
  {
    id: "2",
    name: "Julie Volt",
    specialty: "Dépannage Urgence",
    rating: 4.8,
    reviews: 89,
    location: "Lyon, France",
    available: true,
  },
  {
    id: "3",
    name: "Robert Ampère",
    specialty: "Rénovation Électrique",
    rating: 4.7,
    reviews: 210,
    location: "Marseille, France",
    available: false,
  },
];

export default function EngineersPage() {
  const [searchTerm, setSearchTerm] = useState("");

  return (
    <div className="max-w-7xl mx-auto px-4 py-8 space-y-8">
      <div className="space-y-4">
        <h1 className="text-3xl font-bold">Nos Ingénieurs Experts</h1>
        <div className="relative max-w-xl">
          <Input
            placeholder="Rechercher par nom, ville ou spécialité..."
            className="pl-12"
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
          />
          <Search className="absolute left-4 top-2.5 h-5 w-5 text-gray-400" />
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {ENGINEERS.filter(e => e.name.toLowerCase().includes(searchTerm.toLowerCase())).map((eng) => (
          <Card key={eng.id} className="space-y-4 hover:border-primary transition-colors cursor-pointer group">
            <div className="flex justify-between items-start">
              <div className="bg-primary/5 p-4 rounded-xl group-hover:bg-primary/10 transition-colors">
                <Zap className="h-8 w-8 text-primary" />
              </div>
              {eng.available && (
                <span className="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-medium">
                  Disponible
                </span>
              )}
            </div>

            <div>
              <h3 className="text-xl font-bold">{eng.name}</h3>
              <p className="text-primary text-sm font-medium">{eng.specialty}</p>
            </div>

            <div className="flex items-center space-x-4 text-sm text-gray-600">
              <div className="flex items-center">
                <Star className="h-4 w-4 text-yellow-400 fill-current mr-1" />
                {eng.rating} ({eng.reviews})
              </div>
              <div className="flex items-center">
                <MapPin className="h-4 w-4 mr-1" />
                {eng.location}
              </div>
            </div>

            <Button className="w-full">Demander un Devis</Button>
          </Card>
        ))}
      </div>
    </div>
  );
}
