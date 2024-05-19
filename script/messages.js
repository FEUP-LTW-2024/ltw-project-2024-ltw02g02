document.addEventListener('DOMContentLoaded', () => {
    const chatMessagesContainer = document.querySelector('.messages');
    const sendMessageForm = document.querySelector('.send-message-form');
    const messageTextarea = sendMessageForm.querySelector('textarea');

    // Function to scroll to the bottom of the chat
    function scrollToBottom() {
        chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
    }

    // Function to fetch new messages
    function fetchMessages() {
        const recipientId = sendMessageForm.querySelector('input[name="recipient_id"]').value;

        fetch(`fetch_messages.php?user=${recipientId}`)
            .then(response => response.json())
            .then(data => {
                chatMessagesContainer.innerHTML = '';

                data.messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message', message.sender_id == data.user_id ? 'sent' : 'received');
                    messageElement.innerHTML = `
                        <p>${escapeHtml(message.content)}</p>
                        <span>${formatTime(message.timestamp)}</span>
                    `;
                    chatMessagesContainer.appendChild(messageElement);
                });

                scrollToBottom();
            })
            .catch(error => console.error('Error fetching messages:', error));
    }

    // Function to send a new message
    sendMessageForm.addEventListener('submit', event => {
        event.preventDefault();

        const formData = new FormData(sendMessageForm);

        fetch('send_message.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageTextarea.value = '';
                fetchMessages();
            } else {
                console.error('Error sending message:', data.error);
            }
        })
        .catch(error => console.error('Error sending message:', error));
    });

    // Escape HTML to prevent XSS attacks
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // Format timestamp to HH:MM format
    function formatTime(timestamp) {
        const date = new Date(timestamp);
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    // Poll for new messages every 5 seconds
    setInterval(fetchMessages, 5000);

    // Initial fetch of messages
    fetchMessages();
});
