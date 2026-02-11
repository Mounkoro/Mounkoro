"use client";

import { Card } from "@/components/ui/Card";
import { Button } from "@/components/ui/Button";
import { Calendar as CalendarIcon, Clock, User, MapPin } from "lucide-react";

export default function AppointmentsPage() {
  const appointments = [
    {
      id: "1",
      date: "12 Octobre 2024",
      time: "10:00",
      client: "Alice Smith",
      location: "Paris, FR",
      type: "Installation",
      status: "Confirmé",
    },
    {
      id: "2",
      date: "12 Octobre 2024",
      time: "14:00",
      client: "Bob Martin",
      location: "Boulogne, FR",
      type: "Dépannage",
      status: "En attente",
    },
  ];

  return (
    <div className="max-w-7xl mx-auto px-4 py-8 space-y-8">
      <div className="flex justify-between items-center">
        <h1 className="text-3xl font-bold">Mon Agenda</h1>
        <Button>Planifier un RDV</Button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        {appointments.map((apt) => (
          <Card key={apt.id} className="space-y-4">
            <div className="flex justify-between items-start">
              <div className="flex items-center gap-2 text-primary">
                <CalendarIcon className="h-5 w-5" />
                <span className="font-bold">{apt.date}</span>
              </div>
              <span className={`px-2 py-1 rounded text-xs font-bold ${
                apt.status === "Confirmé" ? "bg-green-100 text-green-700" : "bg-yellow-100 text-yellow-700"
              }`}>
                {apt.status}
              </span>
            </div>

            <div className="space-y-2">
              <div className="flex items-center gap-2 text-gray-600">
                <Clock className="h-4 w-4" />
                <span>{apt.time}</span>
              </div>
              <div className="flex items-center gap-2 text-gray-600">
                <User className="h-4 w-4" />
                <span>{apt.client}</span>
              </div>
              <div className="flex items-center gap-2 text-gray-600">
                <MapPin className="h-4 w-4" />
                <span>{apt.location}</span>
              </div>
            </div>

            <div className="pt-4 flex gap-2">
              <Button size="sm" className="flex-1">Détails</Button>
              <Button size="sm" variant="outline" className="flex-1">Annuler</Button>
            </div>
          </Card>
        ))}
      </div>
    </div>
  );
}
