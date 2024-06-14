<style>
    .float-contact {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 99999;
    }

    .chat-zalo {
        background: #8eb22b;
        border-radius: 20px;
        padding: 0 18px;
        color: white;
        display: block;
        margin-bottom: 6px;
    }

    .chat-face {
        background: #125c9e;
        border-radius: 20px;
        padding: 0 18px;
        color: white;
        display: block;
        margin-bottom: 6px;
    }

    .float-contact .hotline {
        background: #d11a59 !important;
        border-radius: 20px;
        padding: 0 18px;
        color: white;
        display: block;
        margin-bottom: 6px;
    }

    .chat-zalo a,
    .chat-face a,
    .hotline a {
        font-size: 15px;
        color: white;
        font-weight: 400;
        text-transform: none;
        line-height: 0;
    }

    @media (max-width: 549px) {
        .float-contact {
            display: none
        }
    }
</style>
<div class="float-contact">
    <button class="chat-zalo">
        <a href="http://zalo.me/0867592210">Chat Zalo</a>
    </button>
    <button class="chat-face">
        <a href="http://m.me/moosun.vn">Chat Facebook</a>
    </button>
    <button class="hotline">
        <a href="tel:0867592210">Hotline: 0867592210</a>
    </button>
</div>
