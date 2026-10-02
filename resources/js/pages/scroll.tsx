import { Head, Link, router } from '@inertiajs/react';
import { useEffect, useState } from 'react';

type ScrollQuote = {
    id: number;
    text: string;
    date: string; // YYYY-MM-DD
    mirror: {
        name: string;
        title: string;
        accent_color: string;
    };
};

type Props = {
    quotes: ScrollQuote[];
};

function formatDate(date: string): string {
    const [year, month, day] = date.split('-');

    return `${day}.${month}.${year}`;
}

export default function ScrollPage({ quotes }: Props) {
    // Removing takes two taps on the trash icon, so a kept quote is never
    // lost by accident. The armed state clears itself after a few seconds.
    const [armedId, setArmedId] = useState<number | null>(null);

    useEffect(() => {
        if (armedId === null) {
            return;
        }

        const timer = setTimeout(() => setArmedId(null), 3000);

        return () => clearTimeout(timer);
    }, [armedId]);

    const onTrash = (id: number) => {
        if (armedId !== id) {
            setArmedId(id);

            return;
        }

        router.post(
            `/scroll/${id}/favorite`,
            {},
            {
                preserveScroll: true,
                onFinish: () => setArmedId(null),
            },
        );
    };

    return (
        <>
            <Head title="Scroll" />

            <div className="flex flex-1 flex-col px-7 pt-7 pb-8">
                <header className="flex items-start justify-between">
                    <div className="pt-1.5 text-[11px] tracking-[3px] text-neutral-400">
                        SOULGLASS WITHIN
                    </div>
                    <div className="text-right">
                        <div className="font-dot text-3xl leading-none font-black">
                            {String(quotes.length).padStart(3, '0')}
                        </div>
                        <div className="mt-1 text-[10px] tracking-[2px] text-neutral-400">
                            KEPT
                        </div>
                    </div>
                </header>

                <h1 className="font-dot mt-8 text-5xl leading-none font-black tracking-[4px]">
                    SCROLL
                </h1>

                <div className="mt-8">
                    <div className="scroll-roll" aria-hidden="true" />
                    <div className="scroll-body">
                        {quotes.length === 0 ? (
                            <div className="flex flex-col items-center justify-center gap-5 py-10 text-center">
                                <p className="max-w-[16rem] text-neutral-400">
                                    Nothing kept yet. When a quote stays with
                                    you, add it to your scroll.
                                </p>
                                <Link
                                    href="/mirror"
                                    className="flex h-13 items-center rounded-full border border-white px-7 text-sm font-medium tracking-[1px]"
                                >
                                    GO TO THE MIRROR
                                </Link>
                            </div>
                        ) : (
                            <ul className="flex flex-col">
                                {quotes.map((quote, index) => {
                                    const armed = armedId === quote.id;

                                    return (
                                        <li key={quote.id}>
                                            {index > 0 && (
                                                <div
                                                    aria-hidden="true"
                                                    className="my-6 flex items-center gap-3"
                                                >
                                                    <span className="h-px flex-1 bg-neutral-600" />
                                                    <span className="size-1.5 rotate-45 bg-neutral-400" />
                                                    <span className="h-px flex-1 bg-neutral-600" />
                                                </div>
                                            )}

                                            <div className="flex items-center justify-between gap-3">
                                                <span
                                                    className="font-dot text-sm font-bold tracking-[2px]"
                                                    style={{
                                                        color: quote.mirror
                                                            .accent_color,
                                                    }}
                                                >
                                                    {formatDate(quote.date)}
                                                </span>

                                                <div className="-mr-3 flex items-center">
                                                    {armed && (
                                                        <span
                                                            role="status"
                                                            className="text-[10px] tracking-[2px] text-red-400"
                                                        >
                                                            TAP AGAIN
                                                        </span>
                                                    )}
                                                    <button
                                                        type="button"
                                                        onClick={() =>
                                                            onTrash(quote.id)
                                                        }
                                                        aria-label={
                                                            armed
                                                                ? 'Tap again to remove this quote'
                                                                : 'Remove this quote from your scroll'
                                                        }
                                                        className={`flex size-11 cursor-pointer items-center justify-center ${
                                                            armed
                                                                ? 'text-red-400'
                                                                : 'text-neutral-500'
                                                        }`}
                                                    >
                                                        <svg
                                                            width="16"
                                                            height="16"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            strokeWidth="1.8"
                                                            strokeLinecap="round"
                                                            strokeLinejoin="round"
                                                            aria-hidden="true"
                                                        >
                                                            <path d="M4 7h16" />
                                                            <path d="M9 7V4h6v3" />
                                                            <path d="M6 7l1 13h10l1-13" />
                                                            <path d="M10 11v6M14 11v6" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <p className="mt-1 text-xl leading-snug font-medium">
                                                {quote.text}
                                            </p>

                                            <div className="mt-3 text-[10px] tracking-[2px] text-neutral-400 uppercase">
                                                {quote.mirror.name} ·{' '}
                                                {quote.mirror.title}
                                            </div>
                                        </li>
                                    );
                                })}
                            </ul>
                        )}
                    </div>
                    <div className="scroll-roll" aria-hidden="true" />
                </div>
            </div>
        </>
    );
}
