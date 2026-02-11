"use client";

import { Card } from "@/components/ui/Card";
import { Button } from "@/components/ui/Button";
import { Clock, CheckCircle, MessageSquare, Plus, Send } from "lucide-react";
import Link from "next/link";

export default function ClientDashboard() {
  const stats = [
    { label: "En attente", value: "2", icon: Clock, color: "text-yellow-500" },
    { label: "Terminées", value: "12", icon: CheckCircle, color: "text-green-500" },
    { label: "Messages", value: "5", icon: MessageSquare, color: "text-blue-500" },
  ];

  return (
    <div className="max-w-7xl mx-auto px-4 py-8 space-y-8">
      <div className="flex justify-between items-center">
        <div>
          <h1 className="text-3xl font-bold text-gray-900">Tableau de bord</h1>
          <p className="text-gray-600">Bienvenue sur votre espace POINT ELECTRIC</p>
        </div>
        <div className="flex gap-4">
          <Link href="/client/engineers">
            <Button variant="outline">Experts</Button>
          </Link>
          <Link href="/client/requests/new">
            <Button className="flex items-center gap-2">
              <Plus className="h-4 w-4" /> Nouvelle demande
            </Button>
          </Link>
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        {stats.map((stat, i) => (
          <Card key={i} className="flex items-center space-x-4">
            <div className={`${stat.color} p-3 bg-gray-50 rounded-lg`}>
              <stat.icon className="h-6 w-6" />
            </div>
            <div>
              <p className="text-sm text-gray-600">{stat.label}</p>
              <p className="text-2xl font-bold">{stat.value}</p>
            </div>
          </Card>
        ))}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <Card className="space-y-4">
          <h3 className="text-xl font-bold">Interventions récentes</h3>
          <div className="divide-y divide-gray-100">
            {[1, 2, 3].map((_, i) => (
              <div key={i} className="py-4 flex justify-between items-center">
                <div>
                  <p className="font-medium">Installation Électrique</p>
                  <p className="text-sm text-gray-500">Ingénieur: Jean Dupont</p>
                </div>
                <span className="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                  Terminé
                </span>
              </div>
            ))}
          </div>
        </Card>

        <Card className="space-y-4">
          <h3 className="text-xl font-bold">Messages récents</h3>
          <div className="divide-y divide-gray-100">
            {[1, 2].map((_, i) => (
              <div key={i} className="py-4 flex items-start space-x-3">
                <div className="bg-primary/10 h-10 w-10 rounded-full flex items-center justify-center text-primary font-bold">
                  M
                </div>
                <div>
                  <p className="font-medium">Marc Expert</p>
                  <p className="text-sm text-gray-600">Le devis a été mis à jour pour votre...</p>
                </div>
              </div>
            ))}
          </div>
        </Card>
      </div>
    </div>
  );
}
