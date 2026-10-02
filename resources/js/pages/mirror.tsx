import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import type { CSSProperties } from 'react';

type Mirror = {
    slug: string;
    name: string;
    title: string;
    season: string | null;
    accent_color: string;
};

type TodayQuote = {
    id: number;
    text: string;
    date: string; // YYYY-MM-DD
    favorited: boolean;
};

type Props = {
    mirror: Mirror;
    dayCount: number;
    today: TodayQuote | null;
};

// Fall leaves: horizontal position, colour, fall time and head start.
const leaves = [
    { left: '0%', color: 'var(--accent)', duration: 12, delay: -2 },
    { left: '92%', color: '#C4501A', duration: 14, delay: -6 },
    { left: '23%', color: '#C4501A', duration: 16, delay: -9 },
    { left: '38%', color: '#E0A526', duration: 10, delay: -5 },
    { left: '55%', color: 'var(--accent)', duration: 18, delay: -13 },
    { left: '69%', color: '#C4501A', duration: 13, delay: -7 },
    { left: '82%', color: '#E0A526', duration: 15, delay: -1 },
    { left: '15%', color: '#E0A526', duration: 20, delay: -16 },
    { left: '77%', color: 'var(--accent)', duration: 11, delay: -10 },
];

function formatDate(date: string): string {
    const [year, month, day] = date.split('-');

    return `${day}.${month}.${year}`;
}

export default function MirrorPage({ mirror, dayCount, today }: Props) {
    const [busy, setBusy] = useState(false);
    const [justRevealed, setJustRevealed] = useState(false);
    const [copied, setCopied] = useState(false);

    const reveal = () => {
        if (today || busy) {
            return;
        }

        setBusy(true);
        router.post(
            '/mirror/reveal',
            {},
            {
                preserveScroll: true,
                onSuccess: () => setJustRevealed(true),
                onFinish: () => setBusy(false),
            },
        );
    };

    const toggleFavorite = () => {
        if (!today) {
            return;
        }

        router.post(
            `/scroll/${today.id}/favorite`,
            {},
            { preserveScroll: true, preserveState: true },
        );
    };

    const share = async () => {
        if (!today) {
            return;
        }

        const text = `“${today.text}” — ${mirror.name}, Soulglass Within`;

        try {
            if (navigator.share) {
                await navigator.share({ text });
            } else {
                await navigator.clipboard.writeText(text);
                setCopied(true);
                setTimeout(() => setCopied(false), 2000);
            }
        } catch {
            // The person closed the share sheet; nothing to do.
        }
    };

    const frame =
        'mirror-frame flex aspect-[334/420] w-full flex-col p-7 text-left text-white';

    return (
        <>
            <Head title={mirror.name} />

            <div
                className="relative flex flex-1 flex-col overflow-hidden"
                style={{ '--accent': mirror.accent_color } as CSSProperties}
            >
                {mirror.season === 'fall' && (
                    <div
                        aria-hidden="true"
                        className="pointer-events-none absolute inset-0"
                    >
                        {leaves.map((leaf, index) => (
                            <div
                                key={index}
                                className="leaf"
                                style={
                                    {
                                        left: leaf.left,
                                        '--leaf': leaf.color,
                                        animationDuration: `${leaf.duration}s`,
                                        animationDelay: `${leaf.delay}s`,
                                    } as CSSProperties
                                }
                            />
                        ))}
                    </div>
                )}

                <header className="relative flex items-start justify-between px-7 pt-7">
                    <div className="pt-1.5 text-[11px] tracking-[3px] text-neutral-400">
                        SOULGLASS WITHIN
                    </div>
                    <div className="text-right">
                        <div className="font-dot text-3xl leading-none font-black">
                            {String(dayCount).padStart(3, '0')}
                        </div>
                        <div className="mt-1 text-[10px] tracking-[2px] text-neutral-400">
                            DAYS
                        </div>
                    </div>
                </header>

                <div className="relative flex flex-1 flex-col items-center gap-7 px-7 pt-7 pb-6">
                    {today ? (
                        <div
                            className={`${frame} ${justRevealed ? 'mirror-flash' : ''}`}
                        >
                            <div className="text-[11px] tracking-[3px] text-neutral-400 uppercase">
                                {mirror.name} · {mirror.title}
                            </div>
                            <p className="mirror-rise flex flex-1 items-center text-3xl leading-tight font-medium">
                                {today.text}
                            </p>
                            <div
                                className="mirror-rise font-dot font-bold tracking-[2px]"
                                style={{ color: 'var(--accent)' }}
                            >
                                {formatDate(today.date)}
                            </div>
                        </div>
                    ) : (
                        <button
                            type="button"
                            onClick={reveal}
                            disabled={busy}
                            aria-label="Tap the mirror to reveal today's quote"
                            className={`${frame} cursor-pointer items-center justify-center gap-3`}
                        >
                            <span className="font-dot text-6xl leading-none font-black tracking-[6px]">
                                {mirror.name}
                            </span>
                            <span className="text-[11px] tracking-[3px] text-neutral-400 uppercase">
                                {mirror.title}
                                {mirror.season ? ` · ${mirror.season}` : ''}
                            </span>
                        </button>
                    )}

                    {today ? (
                        <div className="mirror-rise flex w-full gap-3">
                            <button
                                type="button"
                                onClick={toggleFavorite}
                                aria-pressed={today.favorited}
                                className={`h-13 flex-1 cursor-pointer rounded-full border border-white text-sm font-medium tracking-[1px] ${
                                    today.favorited
                                        ? 'bg-white text-black'
                                        : 'bg-black text-white'
                                }`}
                            >
                                {today.favorited
                                    ? 'IN YOUR SCROLL'
                                    : 'ADD TO SCROLL'}
                            </button>
                            <button
                                type="button"
                                onClick={share}
                                aria-label="Share this quote"
                                className="flex size-13 cursor-pointer items-center justify-center rounded-full border border-neutral-600 bg-black text-white"
                            >
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    strokeWidth="1.6"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M12 15V3" />
                                    <path d="M7 8l5-5 5 5" />
                                    <path d="M5 13v6h14v-6" />
                                </svg>
                            </button>
                        </div>
                    ) : (
                        <div className="flex h-13 items-center gap-2.5 text-[13px] text-neutral-300">
                            <span
                                className="mirror-pulse size-2 rounded-full"
                                style={{ background: 'var(--accent)' }}
                            />
                            <span>Tap the mirror</span>
                        </div>
                    )}

                    <div
                        role="status"
                        className="h-4 text-xs text-neutral-400"
                    >
                        {copied ? 'Copied to clipboard' : ''}
                    </div>
                </div>
            </div>
        </>
    );
}
