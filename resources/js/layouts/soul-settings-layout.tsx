import { Link, router, usePage } from '@inertiajs/react';
import type { PropsWithChildren } from 'react';
import { logout } from '@/routes';

const sections = [
    { label: 'Profile', href: '/settings/profile' },
    { label: 'Security', href: '/settings/security' },
];

export default function SoulSettingsLayout({ children }: PropsWithChildren) {
    const { url } = usePage();

    return (
        <div className="flex flex-1 flex-col px-7 pt-7 pb-10">
            <div className="text-[11px] tracking-[3px] text-neutral-400">
                SOULGLASS WITHIN
            </div>

            <h1 className="font-dot mt-8 text-5xl leading-none font-black tracking-[4px]">
                SETTINGS
            </h1>

            <nav aria-label="Settings" className="mt-8 flex gap-3">
                {sections.map((section) => {
                    const active = url.startsWith(section.href);

                    return (
                        <Link
                            key={section.href}
                            href={section.href}
                            aria-current={active ? 'page' : undefined}
                            className={`flex h-11 items-center rounded-full border px-5 text-[11px] font-medium tracking-[2px] uppercase ${
                                active
                                    ? 'border-white bg-white text-black'
                                    : 'border-neutral-600 text-neutral-200'
                            }`}
                        >
                            {section.label}
                        </Link>
                    );
                })}
            </nav>

            <section className="soul-settings mt-10 space-y-12">{children}</section>

            <div className="mt-12 border-t border-neutral-800 pt-8">
                <Link
                    href={logout()}
                    as="button"
                    onClick={() => router.flushAll()}
                    className="flex h-13 w-full cursor-pointer items-center justify-center rounded-full border border-neutral-600 text-sm font-medium tracking-[1px] text-white"
                >
                    LOG OUT
                </Link>
            </div>
        </div>
    );
}
