<div class="bot" id="bot">
    <button type="button" class="bot__launcher" id="bot-launcher"
            aria-expanded="false" aria-controls="bot-panel" aria-label="Chat with us">
        <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 11.5a8.4 8.4 0 0 1-9 8.4 9 9 0 0 1-3.8-.8L3 20l1-4.1a8.4 8.4 0 1 1 17-4.4z"/>
        </svg>
    </button>

    <div class="bot__panel" id="bot-panel" hidden>
        <div class="bot__header">
            <p class="bot__title">Stasio Assistant</p>
            <p class="bot__note">Practice questions only — I can't give medical advice.</p>
            <button type="button" class="bot__close" id="bot-close" aria-label="Close chat">&times;</button>
        </div>
        <div class="bot__messages" id="bot-messages" aria-live="polite"></div>
        <form class="bot__form" id="bot-form">
            <input type="text" id="bot-input" placeholder="Type a question…" autocomplete="off">
            <button type="submit" class="bot__send" aria-label="Send">&rarr;</button>
        </form>
    </div>
</div>