"use client";

import { motion } from "framer-motion";
import { Zap, Shield, Clock, Search } from "lucide-react";
import { Button } from "@/components/ui/Button";
import { Card } from "@/components/ui/Card";
import Link from "next/link";

export default function Home() {
  return (
    <motion.div
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      className="flex flex-col items-center"
    >
      {/* Hero Section */}
      <section className="w-full py-20 px-4 bg-white">
        <div className="max-w-7xl mx-auto text-center space-y-8">
          <motion.h1
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            className="text-5xl md:text-7xl font-bold text-gray-900"
          >
            L'Électricité de Demain, <br />
            <span className="text-primary">Aujourd'hui.</span>
          </motion.h1>
          <motion.p
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ delay: 0.2 }}
            className="text-xl text-gray-600 max-w-2xl mx-auto"
          >
            Mise en relation directe entre particuliers et ingénieurs électriciens qualifiés pour tous vos besoins en installation, dépannage et devis.
          </motion.p>
          <motion.div
            initial={{ opacity: 0, scale: 0.9 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ delay: 0.4 }}
            className="flex flex-wrap justify-center gap-4"
          >
            <Link href="/register">
              <Button size="lg">Trouver un Expert</Button>
            </Link>
            <Link href="/register">
              <Button size="lg" variant="outline">Je suis Ingénieur</Button>
            </Link>
          </motion.div>
        </div>
      </section>

      {/* Features Section */}
      <section className="max-w-7xl mx-auto py-20 px-4 grid grid-cols-1 md:grid-cols-3 gap-8 overflow-hidden">
        <Card className="text-center space-y-4">
          <div className="bg-primary/10 w-12 h-12 rounded-full flex items-center justify-center mx-auto text-primary">
            <Shield className="h-6 w-6" />
          </div>
          <h3 className="text-xl font-bold">Experts Certifiés</h3>
          <p className="text-gray-600">Tous nos ingénieurs sont rigoureusement sélectionnés et certifiés.</p>
        </Card>
        <Card className="text-center space-y-4">
          <div className="bg-primary/10 w-12 h-12 rounded-full flex items-center justify-center mx-auto text-primary">
            <Clock className="h-6 w-6" />
          </div>
          <h3 className="text-xl font-bold">Intervention Rapide</h3>
          <p className="text-gray-600">Dépannage en urgence 24/7 pour assurer votre sécurité électrique.</p>
        </Card>
        <Card className="text-center space-y-4">
          <div className="bg-primary/10 w-12 h-12 rounded-full flex items-center justify-center mx-auto text-primary">
            <Search className="h-6 w-6" />
          </div>
          <h3 className="text-xl font-bold">Transparence Totale</h3>
          <p className="text-gray-600">Devis clairs et détaillés avant chaque intervention.</p>
        </Card>
      </section>
    </motion.div>
  );
}
