"use client";

import { useState } from "react";
import { Send, User } from "lucide-react";
import { Button } from "@/components/ui/Button";
import { Input } from "@/components/ui/Input";
import { Card } from "@/components/ui/Card";

interface Message {
  id: string;
  sender: string;
  text: string;
  time: string;
  isMe: boolean;
}

export function ChatBox() {
  const [messages, setMessages] = useState<Message[]>([
    { id: "1", sender: "Ingénieur Marc", text: "Bonjour, j'ai bien reçu votre demande de devis.", time: "10:00", isMe: false },
    { id: "2", sender: "Moi", text: "Parfait, quand seriez-vous disponible pour une visite ?", time: "10:05", isMe: true },
  ]);
  const [inputText, setInputText] = useState("");

  const handleSend = () => {
    if (!inputText.trim()) return;
    const newMessage: Message = {
      id: Date.now().toString(),
      sender: "Moi",
      text: inputText,
      time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
      isMe: true,
    };
    setMessages([...messages, newMessage]);
    setInputText("");
  };

  return (
    <Card className="flex flex-col h-[500px] p-0 overflow-hidden border-primary/20">
      {/* Header */}
      <div className="bg-primary p-4 text-white flex items-center gap-3">
        <div className="bg-white/20 p-2 rounded-full">
          <User className="h-5 w-5" />
        </div>
        <div>
          <p className="font-bold">Chat en direct</p>
          <p className="text-xs text-blue-100">En ligne</p>
        </div>
      </div>

      {/* Messages */}
      <div className="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
        {messages.map((msg) => (
          <div key={msg.id} className={`flex ${msg.isMe ? "justify-end" : "justify-start"}`}>
            <div className={`max-w-[80%] p-3 rounded-2xl text-sm ${
              msg.isMe ? "bg-primary text-white rounded-tr-none" : "bg-white text-gray-800 border border-gray-200 rounded-tl-none"
            }`}>
              <p>{msg.text}</p>
              <p className={`text-[10px] mt-1 ${msg.isMe ? "text-blue-100" : "text-gray-400"}`}>{msg.time}</p>
            </div>
          </div>
        ))}
      </div>

      {/* Input */}
      <div className="p-4 bg-white border-t border-gray-100 flex gap-2">
        <Input
          placeholder="Écrivez votre message..."
          className="flex-1"
          value={inputText}
          onChange={(e) => setInputText(e.target.value)}
          onKeyPress={(e) => e.key === "Enter" && handleSend()}
        />
        <Button size="sm" onClick={handleSend}>
          <Send className="h-4 w-4" />
        </Button>
      </div>
    </Card>
  );
}
