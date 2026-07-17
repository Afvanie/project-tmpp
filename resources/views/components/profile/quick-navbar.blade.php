@php
    /*
    |--------------------------------------------------------------------------
    | QUICK NAVBAR PROFIL
    |--------------------------------------------------------------------------
    |
    | Menu hanya ditampilkan apabila target section tersedia di halaman.
    |
    */

    $profileQuickLinks = [
        [
            'target' => 'profile-overview',
            'label' => 'Profil Singkat',
        ],
        [
            'target' => 'profile-history',
            'label' => 'Sejarah',
        ],
        [
            'target' => 'vision-mission',
            'label' => 'Visi & Misi',
        ],
        [
            'target' => 'program-goals',
            'label' => 'Tujuan Prodi',
        ],
        [
            'target' => 'professional-profile',
            'label' => 'PPM',
        ],
        [
            'target' => 'graduate-learning-outcomes',
            'label' => 'CPL',
        ],
        [
            'target' => 'profile-accreditation',
            'label' => 'Akreditasi',
        ],
    ];
@endphp


<nav
    id="profileQuickNavbar"
    class="sticky z-30
           border-b border-slate-200
           bg-white/95 backdrop-blur-xl"
    style="top: var(--profile-quick-top, 0px);"
    aria-label="Navigasi cepat halaman profil"
>
    <div
        id="profileQuickNavbarScroll"
        class="mx-auto max-w-7xl
               overflow-x-auto scroll-smooth
               px-4
               [scrollbar-width:none]
               [&::-webkit-scrollbar]:hidden
               sm:px-6"
    >
        <ul
            class="mx-auto flex w-max
                   min-w-full items-center
                   justify-start gap-5
                   sm:justify-center
                   sm:gap-7"
        >
            @foreach ($profileQuickLinks as $link)
                <li
                    class="shrink-0"
                    data-profile-quick-item
                >
                    <a
                        href="#{{ $link['target'] }}"
                        data-profile-quick-link
                        data-profile-target="{{ $link['target'] }}"
                        class="profile-quick-link"
                    >
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>


@once
    @push('styles')
        <style>
            .profile-quick-link {
                position: relative;
                display: inline-flex;
                min-height: 46px;
                align-items: center;
                justify-content: center;
                color: #64748b;
                font-size: 11px;
                font-weight: 700;
                line-height: 1;
                white-space: nowrap;
                transition:
                    color 180ms ease;
            }

            .profile-quick-link::after {
                position: absolute;
                right: 0;
                bottom: 0;
                left: 0;
                height: 2px;
                border-radius: 999px 999px 0 0;
                background: #075f9b;
                content: '';
                opacity: 0;
                transform: scaleX(0.35);
                transition:
                    opacity 180ms ease,
                    transform 180ms ease;
            }

            .profile-quick-link:hover {
                color: #075f9b;
            }

            .profile-quick-link.is-active {
                color: #075f9b;
            }

            .profile-quick-link.is-active::after {
                opacity: 1;
                transform: scaleX(1);
            }

            .profile-quick-link:focus-visible {
                border-radius: 6px;
                outline: 3px solid rgba(215, 179, 62, 0.5);
                outline-offset: 2px;
            }

            @media (min-width: 640px) {
                .profile-quick-link {
                    min-height: 48px;
                    font-size: 12px;
                }
            }
        </style>
    @endpush


    @push('scripts')
        <script>
            document.addEventListener(
                'DOMContentLoaded',
                function () {
                    const quickNavbar =
                        document.getElementById(
                            'profileQuickNavbar'
                        );

                    const scroller =
                        document.getElementById(
                            'profileQuickNavbarScroll'
                        );

                    if (
                        !quickNavbar
                        || quickNavbar.dataset.initialized
                            === 'true'
                    ) {
                        return;
                    }

                    quickNavbar.dataset.initialized = 'true';


                    /*
                    |--------------------------------------------------------------------------
                    | CARI NAVBAR UTAMA SECARA OTOMATIS
                    |--------------------------------------------------------------------------
                    */

                    function findPrimaryNavbar() {
                        const preferredSelectors = [
                            '[data-site-navbar]',
                            '[data-navbar]',
                            '#navbar',
                            '#mainNavbar',
                            '#main-navbar',
                            'header',
                            'body > nav',
                        ];

                        for (
                            const selector
                            of preferredSelectors
                        ) {
                            const elements =
                                document.querySelectorAll(
                                    selector
                                );

                            for (const element of elements) {
                                if (
                                    element === quickNavbar
                                    || element.contains(
                                        quickNavbar
                                    )
                                ) {
                                    continue;
                                }

                                const style =
                                    window.getComputedStyle(
                                        element
                                    );

                                const rect =
                                    element
                                        .getBoundingClientRect();

                                const isPinned =
                                    style.position === 'fixed'
                                    || style.position === 'sticky';

                                const isAtTop =
                                    rect.top <= 4
                                    && rect.bottom > 20;

                                const isVisible =
                                    style.display !== 'none'
                                    && style.visibility
                                        !== 'hidden'
                                    && rect.height > 0;

                                if (
                                    isPinned
                                    && isAtTop
                                    && isVisible
                                ) {
                                    return element;
                                }
                            }
                        }

                        const candidates =
                            document.querySelectorAll(
                                'header, nav, [role="navigation"]'
                            );

                        for (const element of candidates) {
                            if (
                                element === quickNavbar
                                || element.contains(
                                    quickNavbar
                                )
                            ) {
                                continue;
                            }

                            const style =
                                window.getComputedStyle(
                                    element
                                );

                            const rect =
                                element
                                    .getBoundingClientRect();

                            const isPinned =
                                style.position === 'fixed'
                                || style.position === 'sticky';

                            if (
                                isPinned
                                && rect.top <= 4
                                && rect.bottom > 20
                                && rect.bottom < 220
                                && rect.height > 0
                            ) {
                                return element;
                            }
                        }

                        return null;
                    }


                    let primaryNavbar =
                        findPrimaryNavbar();


                    function getPrimaryNavbarBottom() {
                        if (!primaryNavbar) {
                            primaryNavbar =
                                findPrimaryNavbar();
                        }

                        if (!primaryNavbar) {
                            return 0;
                        }

                        const style =
                            window.getComputedStyle(
                                primaryNavbar
                            );

                        const rect =
                            primaryNavbar
                                .getBoundingClientRect();

                        const isPinned =
                            style.position === 'fixed'
                            || style.position === 'sticky';

                        if (!isPinned) {
                            return 0;
                        }

                        return Math.max(
                            0,
                            Math.round(rect.bottom)
                        );
                    }


                    function updateQuickNavbarPosition() {
                        quickNavbar.style.setProperty(
                            '--profile-quick-top',
                            getPrimaryNavbarBottom()
                                + 'px'
                        );
                    }


                    function getTotalScrollOffset() {
                        return getPrimaryNavbarBottom()
                            + quickNavbar.offsetHeight
                            + 14;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | HAPUS MENU YANG TARGETNYA TIDAK ADA
                    |--------------------------------------------------------------------------
                    */

                    const validLinks = [];

                    quickNavbar
                        .querySelectorAll(
                            '[data-profile-quick-link]'
                        )
                        .forEach(function (link) {
                            const targetId =
                                link.dataset.profileTarget;

                            const target =
                                document.getElementById(
                                    targetId
                                );

                            if (!target) {
                                const item = link.closest(
                                    '[data-profile-quick-item]'
                                );

                                if (item) {
                                    item.remove();
                                }

                                return;
                            }

                            validLinks.push({
                                link: link,
                                target: target,
                                id: targetId,
                            });
                        });


                    if (validLinks.length === 0) {
                        quickNavbar.classList.add(
                            'hidden'
                        );

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | MENU AKTIF
                    |--------------------------------------------------------------------------
                    */

                    let activeId = null;

                    function keepActiveLinkVisible(link) {
                        if (!scroller || !link) {
                            return;
                        }

                        const scrollerRect =
                            scroller
                                .getBoundingClientRect();

                        const linkRect =
                            link.getBoundingClientRect();

                        const outsideLeft =
                            linkRect.left
                            < scrollerRect.left + 16;

                        const outsideRight =
                            linkRect.right
                            > scrollerRect.right - 16;

                        if (
                            !outsideLeft
                            && !outsideRight
                        ) {
                            return;
                        }

                        const nextScrollLeft =
                            scroller.scrollLeft
                            + linkRect.left
                            - scrollerRect.left
                            - (
                                scroller.clientWidth
                                - linkRect.width
                            ) / 2;

                        scroller.scrollTo({
                            left: Math.max(
                                0,
                                nextScrollLeft
                            ),
                            behavior: 'smooth',
                        });
                    }


                    function setActiveLink(id) {
                        if (!id || activeId === id) {
                            return;
                        }

                        activeId = id;

                        validLinks.forEach(
                            function (entry) {
                                const isActive =
                                    entry.id === id;

                                entry.link.classList.toggle(
                                    'is-active',
                                    isActive
                                );

                                if (isActive) {
                                    entry.link.setAttribute(
                                        'aria-current',
                                        'location'
                                    );

                                    keepActiveLinkVisible(
                                        entry.link
                                    );
                                } else {
                                    entry.link.removeAttribute(
                                        'aria-current'
                                    );
                                }
                            }
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SCROLL SPY
                    |--------------------------------------------------------------------------
                    */

                    let animationFrame = null;

                    function updateActiveFromScroll() {
                        animationFrame = null;

                        updateQuickNavbarPosition();

                        const marker =
                            window.scrollY
                            + getTotalScrollOffset()
                            + 24;

                        let currentEntry =
                            validLinks[0];

                        validLinks.forEach(
                            function (entry) {
                                if (
                                    entry.target.offsetTop
                                    <= marker
                                ) {
                                    currentEntry = entry;
                                }
                            }
                        );

                        setActiveLink(
                            currentEntry.id
                        );
                    }


                    function requestUpdate() {
                        if (animationFrame !== null) {
                            return;
                        }

                        animationFrame =
                            window.requestAnimationFrame(
                                updateActiveFromScroll
                            );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | KLIK MENU
                    |--------------------------------------------------------------------------
                    */

                    validLinks.forEach(
                        function (entry) {
                            entry.link.addEventListener(
                                'click',
                                function (event) {
                                    event.preventDefault();

                                    updateQuickNavbarPosition();

                                    const targetTop =
                                        entry.target
                                            .getBoundingClientRect()
                                            .top
                                        + window.scrollY
                                        - getTotalScrollOffset();

                                    setActiveLink(
                                        entry.id
                                    );

                                    window.scrollTo({
                                        top: Math.max(
                                            0,
                                            targetTop
                                        ),
                                        behavior: 'smooth',
                                    });

                                    history.replaceState(
                                        null,
                                        '',
                                        '#' + entry.id
                                    );
                                }
                            );
                        }
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | INISIALISASI
                    |--------------------------------------------------------------------------
                    */

                    updateQuickNavbarPosition();
                    updateActiveFromScroll();

                    window.addEventListener(
                        'scroll',
                        requestUpdate,
                        {
                            passive: true,
                        }
                    );

                    window.addEventListener(
                        'resize',
                        function () {
                            primaryNavbar =
                                findPrimaryNavbar();

                            requestUpdate();
                        }
                    );


                    const initialHash =
                        window.location.hash
                            .replace('#', '');

                    const initialEntry =
                        validLinks.find(
                            function (entry) {
                                return entry.id
                                    === initialHash;
                            }
                        );

                    if (initialEntry) {
                        window.setTimeout(
                            function () {
                                updateQuickNavbarPosition();

                                const targetTop =
                                    initialEntry.target
                                        .getBoundingClientRect()
                                        .top
                                    + window.scrollY
                                    - getTotalScrollOffset();

                                window.scrollTo({
                                    top: Math.max(
                                        0,
                                        targetTop
                                    ),
                                    behavior: 'auto',
                                });

                                setActiveLink(
                                    initialEntry.id
                                );
                            },
                            100
                        );
                    }
                }
            );
        </script>
    @endpush
@endonce
