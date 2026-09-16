@props([
    'name' => '',
    'url' => '#',
    'buttonClass' => 'inline-flex w-full items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-teal-300 hover:bg-teal-50 hover:text-teal-700 dark:!border-slate-700 dark:bg-slate-800 dark:!text-white dark:hover:!border-teal-500/50 dark:hover:bg-slate-900 dark:hover:text-teal-300',
])

@php

    $platforms = [
        [
            'key' => 'whatsapp',
            'label' => 'WhatsApp',
            'icon' => '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>',
        ],
        [
            'key' => 'x',
            'label' => 'X',
            'icon' => '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        ],
        [
            'key' => 'facebook',
            'label' => 'Facebook',
            'icon' => '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.01 3.66 9.15 8.44 9.94v-7.03H7.9v-2.91h2.54V9.68c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.91h-2.34V22A10.06 10.06 0 0 0 22 12.06z"/></svg>',
        ],
        [
            'key' => 'telegram',
            'label' => 'Telegram',
            'icon' => '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>',
        ],
        [
            'key' => 'linkedin',
            'label' => 'LinkedIn',
            'icon' => '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 1 1 0-4.125 2.062 2.062 0 0 1 0 4.125zM7.119 20.452H3.553V9h3.566v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        ],
        [
            'key' => 'email',
            'label' => 'Email',
            'icon' => '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        ],
    ];
@endphp

<div x-data='{
    open: false,
    copied: false,
    init() {
        this.message = this.name !== ""
            ? "I recently had a great experience with " + this.name + ".\n\nLeave a review and share your own experience here:\n\n" + this.url
            : "Share your experience with our business and leave a review here:\n\n" + this.url;
    },
    message: "",
    name: {{ Illuminate\Support\Js::encode($name) }},
    url: {{ Illuminate\Support\Js::encode($url) }},
    subject: "Review for " + {{ Illuminate\Support\Js::encode($name) }},
    openLink(network) {
        const text = encodeURIComponent(this.message);
        const link = encodeURIComponent(this.url);
        const subject = encodeURIComponent(this.subject);
        const targets = {
            whatsapp: "https://api.whatsapp.com/send?text=" + text,
            x: "https://twitter.com/intent/tweet?text=" + text,
            telegram: "https://t.me/share/url?url=" + link + "&text=" + text,
            facebook: "https://www.facebook.com/sharer/sharer.php?u=" + link,
            linkedin: "https://www.linkedin.com/sharing/share-offsite/?url=" + link,
            email: "mailto:?subject=" + subject + "&body=" + text
        };
        window.open(targets[network], "_blank", "noopener,noreferrer");
    },
    async copyMessage() {
        await navigator.clipboard.writeText(this.message);
        this.copied = true;
        setTimeout(() => this.copied = false, 1500);
    }
}'>
    <button type="button" @click="open = true" class="{{ $buttonClass }}">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="m16 6-4-4-4 4" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 2v13" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span>Share</span>
    </button>

    <template x-teleport="body">
        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="open = false" @keydown.escape.window="open = false"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-slate-900/35 px-4 py-6 backdrop-blur-[2px]"
            aria-modal="true" role="dialog">
            <div @click.stop
                class="theme-scrollbar max-h-[calc(100vh-3rem)] w-full max-w-md overflow-y-auto rounded-[28px] border border-slate-200 bg-white/95 p-5 shadow-[0_28px_80px_rgba(15,23,42,0.22)] ring-1 ring-slate-200/70 dark:border-slate-700 dark:bg-slate-800/95 dark:ring-slate-700/80 sm:p-6"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                <div
                    class="mb-5 overflow-hidden rounded-[22px] border border-slate-200 bg-gradient-to-r from-slate-50 via-white to-teal-50 shadow-sm dark:border-slate-700 dark:from-slate-900 dark:via-slate-900 dark:to-teal-950/60">
                    <div class="flex items-center justify-between gap-3 px-3 py-2.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-teal-500 via-teal-600 to-cyan-600 text-white shadow-md shadow-teal-500/30 ring-4 ring-white/70 dark:shadow-teal-950/40 dark:ring-slate-900/60">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path d="m16 6-4-4-4 4" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 2v13" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div>
                                <p
                                    class="text-[10px] font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">
                                    Share link</p>
                                <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $name }}</h3>
                            </div>
                        </div>

                        <button type="button" @click="open = false"
                            class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:border-slate-300 hover:text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:text-slate-100"
                            aria-label="Close dialog">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <h2 class="text-[1.7rem] font-bold tracking-[-0.04em] text-slate-900 dark:text-white">Share
                    {{ $name }}</h2>
                <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-300">Share the ready-made review invitation
                    with your clients.</p>

                <p class="mt-6 text-xs font-semibold uppercase tracking-[0.2em] text-slate-600 dark:text-slate-300">
                    Ready-made message</p>
                <div
                    class="theme-scrollbar mt-2 max-h-28 overflow-y-auto whitespace-pre-wrap rounded-xl border border-slate-200 bg-slate-50 p-3 text-xs leading-relaxed text-slate-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300"
                    x-text="message"></div>

                <button type="button" @click="copyMessage()"
                    class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-teal-500/20 transition hover:from-teal-700 hover:to-cyan-700">
                    <svg x-show="!copied" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                    </svg>
                    <svg x-show="copied" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span x-text="copied ? 'Copied to clipboard!' : 'Copy message'"></span>
                </button>

                <div class="mt-4 grid grid-cols-3 gap-2 border-t border-slate-100 pt-4 dark:border-slate-800">
                    @foreach ($platforms as $platform)
                        <button type="button" @click="openLink('{{ $platform['key'] }}')"
                            class="flex flex-col items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-2 py-2.5 text-[11px] font-semibold text-slate-600 transition hover:border-teal-300 hover:bg-teal-50 hover:text-teal-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:border-teal-500/50 dark:hover:bg-teal-500/10 dark:hover:text-teal-300">
                            {!! $platform['icon'] !!}
                            <span>{{ $platform['label'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </template>
</div>