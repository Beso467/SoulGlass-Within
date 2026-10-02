import { Link, usePage } from '@inertiajs/react';
import type { ReactNode } from 'react';
import '../../css/soulglass.css';

type Tab = {
    label: string;
    href: string;
    match: string;
    icon: ReactNode;
};

const iconProps = {
    width: 22,
    height: 22,
    viewBox: '0 0 24 24',
    fill: 'none',
    stroke: 'currentColor',
    strokeWidth: 1.6,
    strokeLinecap: 'round',
    strokeLinejoin: 'round',
    'aria-hidden': true,
} as const;

const tabs: Tab[] = [
    {
        label: 'Mirror',
        href: '/mirror',
        match: '/mirror',
        icon: (
            <svg {...iconProps}>
                <rect x="4" y="3.5" width="16" height="17" rx="3.5" />
                <path d="M8.5 11.5l4-4" />
                <path d="M9.5 15.5l6-6" />
            </svg>
        ),
    },
    {
        label: 'Scroll',
        href: '/scroll',
        match: '/scroll',
        icon: (
            <svg {...iconProps}>
                <path d="M8 21h12a2 2 0 0 0 2-2v-2H10v2a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v3h4" />
                <path d="M19 17V5a2 2 0 0 0-2-2H4" />
            </svg>
        ),
    },
    {
        label: 'Lore',
        href: '/lore',
        match: '/lore',
        icon: (
            <svg {...iconProps}>
                <path d="M12 6c-2-1.5-5-2-8-1.5v13c3-.5 6 0 8 1.5 2-1.5 5-2 8-1.5v-13c-3-.5-6 0-8 1.5z" />
                <path d="M12 6v13" />
            </svg>
        ),
    },
    {
        label: 'Settings',
        href: '/settings/profile',
        match: '/settings',
        icon: (
            <svg {...iconProps}>
                <path d="M4 7h16M4 12h16M4 17h16" />
                <circle cx="9" cy="7" r="2" fill="#000" />
                <circle cx="15" cy="12" r="2" fill="#000" />
                <circle cx="8" cy="17" r="2" fill="#000" />
            </svg>
        ),
    },
];

export default function SoulLayout({ children }: { children: ReactNode }) {
    const { url } = usePage();

    return (
        <div className="min-h-dvh bg-black font-sans text-white">
            <div className="mx-auto flex min-h-dvh w-full max-w-md flex-col">
                <main className="relative flex flex-1 flex-col">
                    {children}
                </main>

                <nav
                    aria-label="Main"
                    className="sticky bottom-0 z-10 grid grid-cols-4 border-t border-neutral-900 bg-black px-2 pt-2 pb-5"
                >
                    {tabs.map((tab) => {
                        const active = url.startsWith(tab.match);

                        return (
                            <Link
                                key={tab.label}
                                href={tab.href}
                                aria-current={active ? 'page' : undefined}
                                className={`flex h-14 flex-col items-center justify-center gap-1.5 text-[10px] font-medium tracking-[2px] uppercase ${
                                    active ? 'text-white' : 'text-neutral-400'
                                }`}
                            >
                                {tab.icon}
                                <span>{tab.label}</span>
                            </Link>
                        );
                    })}
                </nav>
            </div>
        </div>
    );
}
