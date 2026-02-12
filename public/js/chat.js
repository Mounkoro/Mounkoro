function initChat(receiverId, currentUserId) {
    const chatBox = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');

    function fetchMessages() {
        fetch(`/api/messages/${receiverId}`)
            .then(response => response.json())
            .then(messages => {
                chatBox.innerHTML = '';
                messages.forEach(msg => {
                    const isMe = msg.sender_id == currentUserId;
                    const div = document.createElement('div');
                    div.className = `flex ${isMe ? 'justify-end' : 'justify-start'} mb-4`;
                    div.innerHTML = `
                        <div class="${isMe ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'} rounded-lg px-4 py-2 max-w-[70%] shadow-sm">
                            <p class="text-sm">${msg.content}</p>
                            <span class="text-[10px] opacity-70 block text-right">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                        </div>
                    `;
                    chatBox.appendChild(div);
                });
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    }

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const content = chatInput.value.trim();
        if (!content) return;

        fetch('/api/messages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                content: content
            })
        })
        .then(response => response.json())
        .then(() => {
            chatInput.value = '';
            fetchMessages();
        });
    });

    fetchMessages();
    setInterval(fetchMessages, 5000);
}
