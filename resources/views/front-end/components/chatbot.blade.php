<script async>
    window.difyChatbotConfig = {
        token: 'rBcBNOX7Lt9n08l8',
        inputs: {},
        systemVariables: {},
        userVariables: {},
    }
</script>
<script
    src="https://udify.app/embed.min.js"
    id="rBcBNOX7Lt9n08l8"
    async>
</script>
<style>
    @keyframes chatbot-ring {
        0%   { box-shadow: 0 4px 20px rgba(255,119,0,0.6), 0 0 0 0   rgba(255,119,0,0.35); }
        70%  { box-shadow: 0 4px 20px rgba(255,119,0,0.6), 0 0 0 18px rgba(255,119,0,0); }
        100% { box-shadow: 0 4px 20px rgba(255,119,0,0.6), 0 0 0 0   rgba(255,119,0,0); }
    }
    @keyframes chatbot-spin {
        to { transform: rotate(360deg); }
    }
    #dify-chatbot-bubble-button {
        background-color: #ff7700 !important;
        position: fixed !important;
        right: 40px !important;
        bottom: 20px !important;
        width: 64px !important;
        height: 64px !important;
        animation: chatbot-ring 2.2s ease-out infinite !important;
    }
    #dify-chatbot-bubble-button svg {
        width: 32px !important;
        height: 32px !important;
    }
    #dify-chatbot-bubble-window :hover {
        background-color: #258aff !important;
    }
    #dify-chatbot-bubble-window {
        width: 24rem !important;
        height: 40rem !important;
        position: fixed !important;
    }
    #chatbot-loader {
        position: fixed;
        right: 40px;
        bottom: 20px;
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(255, 119, 0, 0.08);
        border: 3px solid rgba(255, 119, 0, 0.2);
        border-top-color: #ff7700;
        animation: chatbot-spin 0.9s linear infinite;
        z-index: 99997;
        transition: opacity 0.3s ease;
    }
    #chatbot-loader.hidden {
        opacity: 0;
        pointer-events: none;
    }
    #chatbot-label {
        position: fixed;
        right: 40px;
        bottom: 92px;
        background: #ffffff;
        color: #ff7700;
        font-weight: 700;
        font-size: 13px;
        line-height: 1.3;
        padding: 8px 14px;
        border-radius: 20px;
        white-space: nowrap;
        box-shadow: 0 3px 14px rgba(0,0,0,0.15);
        z-index: 99998;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        transform: translateX(10px);
        transition: opacity 0.4s ease, transform 0.4s ease, visibility 0.4s ease;
    }
    #chatbot-label.visible {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }
    #chatbot-label::after {
        content: '';
        position: absolute;
        bottom: -10px;
        right: 24px;
        border: 6px solid transparent;
        border-top-color: #ffffff;
    }
    @media (max-width: 576px) {
        #dify-chatbot-bubble-button { right: 20px !important; bottom: 20px !important; }
        #chatbot-loader { right: 20px; }
        #chatbot-label { right: 20px; }
    }
</style>

<div id="chatbot-loader"></div>
<div id="chatbot-label">👋 กำลังมองหาบริษัทอยู่ใช่ไหม?<br>ให้เราช่วยคุณสิ บอกความต้องการมาได้เลย</div>

<script>
    (function () {
        var label = document.getElementById('chatbot-label');
        var loader = document.getElementById('chatbot-loader');
        var observer = new MutationObserver(function () {
            var btn = document.getElementById('dify-chatbot-bubble-button');
            if (btn) {
                observer.disconnect();
                if (loader) {
                    loader.classList.add('hidden');
                    setTimeout(function () { loader.remove(); }, 300);
                }
                if (label) {
                    setTimeout(function () {
                        label.classList.add('visible');
                    }, 400);
                    btn.addEventListener('click', function () {
                        label.style.display = 'none';
                    }, { once: true });
                }
            }
        });
        observer.observe(document.body, { childList: true, subtree: true });
    })();
</script>
