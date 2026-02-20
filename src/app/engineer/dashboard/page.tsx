"use client";

import { useState, useEffect } from "react";
import { Card } from "@/components/ui/Card";
import { Button } from "@/components/ui/Button";
import { TrendingUp, Users, Calendar, FileText, Plus, Bell, X } from "lucide-react";
import Link from "next/link";
import { motion, AnimatePresence } from "framer-motion";

export default function EngineerDashboard() {
  const [notifications, setNotifications] = useState<any[]>([]);
  const [showAlert, setShowAlert] = useState(false);

  useEffect(() => {
    const fetchNotifications = async () => {
      try {
        const res = await fetch("/api/notifications");
        if (res.ok) {
          const data = await res.json();
          if (data.length > notifications.length) {
            setShowAlert(true);
          }
          setNotifications(data);
        }
      } catch (err) {
        console.error("Failed to fetch notifications");
      }
    };

    fetchNotifications();
    const interval = setInterval(fetchNotifications, 10000); // Poll every 10s
    return () => clearInterval(interval);
  }, [notifications.length]);
  const stats = [
    { label: "Revenus (Mois)", value: "4,250 €", icon: TrendingUp, color: "text-green-500" },
    { label: "Clients Actifs", value: "8", icon: Users, color: "text-blue-500" },
    { label: "Rendez-vous", value: "12", icon: Calendar, color: "text-purple-500" },
    { label: "Factures", value: "24", icon: FileText, color: "text-orange-500" },
  ];

  return (
    <div className="max-w-7xl mx-auto px-4 py-8 space-y-8 relative">
      <AnimatePresence>
        {showAlert && notifications.length > 0 && (
          <motion.div
            initial={{ opacity: 0, y: -50, scale: 0.9 }}
            animate={{ opacity: 1, y: 0, scale: 1 }}
            exit={{ opacity: 0, scale: 0.9 }}
            className="fixed top-20 right-4 z-50 w-full max-w-sm"
          >
            <div className="bg-primary text-white p-4 rounded-2xl shadow-2xl border-4 border-white flex items-start gap-4 animate-pulsate">
              <div className="bg-white/20 p-2 rounded-full">
                <Bell className="h-6 w-6 animate-bounce" />
              </div>
              <div className="flex-1">
                <p className="font-bold">Nouvelle Mission !</p>
                <p className="text-sm text-white/90">
                  {notifications[0].type === "EMERGENCY" ? "🚨 Urgence :" : "📋 Demande :"} {notifications[0].description.substring(0, 40)}...
                </p>
                <div className="mt-2 flex gap-2">
                  <Button size="sm" variant="secondary" className="bg-white text-primary border-none hover:bg-gray-100" onClick={() => setShowAlert(false)}>
                    Voir
                  </Button>
                </div>
              </div>
              <button onClick={() => setShowAlert(false)} className="hover:bg-white/10 p-1 rounded">
                <X className="h-4 w-4" />
              </button>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
      <div className="flex justify-between items-center">
        <div>
          <h1 className="text-3xl font-bold text-gray-900">Espace Ingénieur</h1>
          <p className="text-gray-600">Gérez vos interventions et vos clients en toute simplicité.</p>
        </div>
        <Link href="/engineer/invoices/new">
          <Button className="flex items-center gap-2">
            <Plus className="h-4 w-4" /> Nouvelle Facture
          </Button>
        </Link>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {stats.map((stat, i) => (
          <Card key={i} className="space-y-2">
            <div className="flex justify-between items-start">
              <div className={`${stat.color} p-2 bg-gray-50 rounded-lg`}>
                <stat.icon className="h-5 w-5" />
              </div>
            </div>
            <p className="text-2xl font-bold">{stat.value}</p>
            <p className="text-sm text-gray-600">{stat.label}</p>
          </Card>
        ))}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <Card className="lg:col-span-2 space-y-6">
          <div className="flex justify-between items-center">
            <h3 className="text-xl font-bold">Demandes en attente</h3>
            <Button variant="outline" size="sm">Voir tout</Button>
          </div>
          <div className="space-y-4">
            {[1, 2, 3].map((_, i) => (
              <div key={i} className="flex items-center justify-between p-4 bg-secondary rounded-xl border border-gray-100 group hover:border-primary transition-colors">
                <div className="flex items-center gap-4">
                  <div className="h-10 w-10 bg-white rounded-full flex items-center justify-center font-bold text-primary">
                    {i === 0 ? "AS" : i === 1 ? "LM" : "PR"}
                  </div>
                  <div>
                    <p className="font-bold">Dépannage Urgent</p>
                    <p className="text-sm text-gray-500">Paris 15e • Il y a {15 * (i+1)} min</p>
                  </div>
                </div>
                <div className="flex gap-2">
                  <Button size="sm" variant="outline">Décliner</Button>
                  <Button size="sm">Accepter</Button>
                </div>
              </div>
            ))}
          </div>
        </Card>

        <Card className="space-y-6">
          <h3 className="text-xl font-bold">Agenda du jour</h3>
          <div className="space-y-4">
            {[
              { time: "09:00", task: "Installation - M. Durand" },
              { time: "14:30", task: "Maintenance - Mme. Leroy" },
              { time: "16:00", task: "Devis - Studio Paris 11" }
            ].map((item, i) => (
              <div key={i} className="flex gap-4 items-start">
                <span className="text-sm font-bold text-primary w-12">{item.time}</span>
                <div className="flex-1 p-3 bg-white border border-gray-100 rounded-lg shadow-sm">
                  <p className="text-sm font-medium">{item.task}</p>
                </div>
              </div>
            ))}
          </div>
          <Link href="/engineer/appointments">
            <Button variant="secondary" className="w-full mt-4">Voir l'agenda complet</Button>
          </Link>
        </Card>
      </div>
    </div>
  );
}
