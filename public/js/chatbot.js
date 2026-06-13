(function () {
    var WA = 'https://wa.me/263787421248';
    var CSRF = document.querySelector('meta[name="csrf-token"]').content;
    var URGENT = ['emergency', 'chest pain', 'bleeding', 'unconscious', 'collapsed', "can't breathe", 'cant breathe', 'severe pain', 'overdose'];

    var history = [];
    var msgs = document.getElementById('bot-messages'),
        panel = document.getElementById('bot-panel'),
        launcher = document.getElementById('bot-launcher'),
        form = document.getElementById('bot-form'),
        input = document.getElementById('bot-input'),
        typing = null;

    function add(text, who, action) {
        var b = document.createElement('div');
        b.className = 'bot__msg bot__msg--' + who;
        b.textContent = text;
        if (action) {
            var a = document.createElement('a');
            a.className = 'bot__action';
            a.href = action.href;
            a.textContent = action.label;
            if (action.href.indexOf('http') === 0) {
                a.target = '_blank';
                a.rel = 'noopener';
            } else if (action.href.charAt(0) === '#') {
                a.addEventListener('click', function () {
                    panel.hidden = true;
                    launcher.setAttribute('aria-expanded', 'false');
                });
            }
            b.appendChild(a);
        }
        msgs.appendChild(b);
        msgs.scrollTop = msgs.scrollHeight;
        return b;
    }

    function showTyping() { typing = add('\u2026', 'bot'); typing.classList.add('bot__msg--typing'); }
    function hideTyping() { if (typing) { typing.remove(); typing = null; } }

    function send(q) {
        add(q, 'user');
        history.push({ role: 'user', text: q });

        var s = q.toLowerCase();
        for (var i = 0; i < URGENT.length; i++) {
            if (s.indexOf(URGENT[i]) !== -1) {
                add('If this is a medical emergency, please don\u2019t wait for a chatbot \u2014 call us now on +263 55 256 3492, or go to your nearest emergency department immediately.', 'bot',
                    { label: 'Call the centre', href: 'tel:+263552563492' });
                return;
            }
        }

        showTyping();
        fetch('/chatbot', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ messages: history.slice(-12) })
        })
        .then(function (r) { return r.json(); })
        .then(function (d) {
            hideTyping();
            if (!d.reply) throw new Error();
            add(d.reply, 'bot', d.action);
            history.push({ role: 'model', text: d.reply });
        })
        .catch(function () {
            hideTyping();
            add('I\u2019m having trouble answering right now \u2014 but the team replies quickly on WhatsApp.', 'bot',
                { label: 'Chat on WhatsApp', href: WA });
        });
    }

    function toggle() {
        var open = panel.hidden;
        panel.hidden = !open;
        launcher.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (open && !msgs.children.length) {
            add('Hi! \uD83D\uDC4B I\u2019m the Stasio assistant. Ask me anything about the practice \u2014 hours, medical aid, services, booking. For medical concerns I\u2019ll connect you to the team.', 'bot');
        }
        if (open) input.focus();
    }

    launcher.addEventListener('click', toggle);
    document.getElementById('bot-close').addEventListener('click', toggle);
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var q = input.value.trim();
        if (!q) return;
        input.value = '';
        send(q);
    });
})();