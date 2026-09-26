@once
<style>
    @media (max-width: 767px) {
        .services-responsive > section:not(:first-of-type) {
            padding-top: 4rem !important;
            padding-bottom: 4rem !important;
        }

        .services-responsive h2 {
            font-size: 2rem !important;
            line-height: 1.2 !important;
        }

        .services-responsive h3,
        .services-responsive h4 {
            font-size: 1.35rem !important;
            line-height: 1.25 !important;
        }

        .services-responsive .carousel-item {
            padding: 1.5rem !important;
        }

        .services-responsive [class*="px-14"] {
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }
    }

    @media (min-width: 768px) and (max-width: 1023px) {
        .services-responsive > section:first-of-type {
            height: 72vh !important;
            min-height: 540px;
            max-height: 680px;
        }

        .services-responsive > section:first-of-type [class*="h-[120vh]"],
        .services-responsive > section:first-of-type [class*="md:h-[90vh]"] {
            height: 100% !important;
            padding-inline: 1.5rem;
        }

        .services-responsive > section:first-of-type h1 {
            font-size: 3.5rem !important;
            line-height: 1.08 !important;
        }

        .services-responsive [class*="md:max-w-[950px]"] {
            max-width: 720px !important;
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }

        .services-responsive > section:not(:first-of-type) {
            padding-top: 4.5rem !important;
            padding-bottom: 4.5rem !important;
        }

        .services-responsive [class*="gap-40"] {
            flex-direction: column !important;
            gap: 3rem !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .services-responsive [class*="gap-40"] > * {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .services-responsive [class*="gap-40"] .space-y-12 {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 2rem !important;
            margin-top: 0 !important;
        }

        .services-responsive [class*="gap-40"] .space-y-12 > :not([hidden]) ~ :not([hidden]) {
            margin-top: 0 !important;
        }

        .services-responsive [class*="gap-40"] .space-y-12 > div {
            align-items: flex-start !important;
        }

        .services-responsive > section:nth-of-type(2) > div > div:not([class*="gap-40"]) {
            flex-direction: column !important;
            gap: 2.5rem !important;
        }

        .services-responsive > section:nth-of-type(2) > div > div:not([class*="gap-40"]) > div {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-bottom: 0 !important;
        }

        .services-responsive > section:nth-of-type(2) .carousel-item {
            width: calc(50% - 0.75rem) !important;
            min-width: calc(50% - 0.75rem);
        }

        .services-responsive [class*="md:pr-24"],
        .services-responsive [class*="md:pl-24"],
        .services-responsive [class*="md:pr-12"],
        .services-responsive [class*="md:pl-12"] {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .services-responsive h2 {
            font-size: 2.625rem !important;
            line-height: 1.15 !important;
        }

        .services-responsive h3,
        .services-responsive h4 {
            font-size: 1.5rem !important;
            line-height: 1.25 !important;
        }

        .services-responsive p,
        .services-responsive [class*="text-[18px]"],
        .services-responsive [class*="text-[21.28px]"] {
            font-size: 1rem !important;
            line-height: 1.75 !important;
        }

        .services-responsive [class*="text-[71px]"] {
            font-size: 3.25rem !important;
        }

        .services-responsive .carousel-item {
            padding: 1.75rem !important;
        }

        .services-responsive [class*="px-14"],
        .services-responsive [class*="px-10"] {
            padding-left: 2.5rem !important;
            padding-right: 2.5rem !important;
        }

        .services-responsive [class*="mb-24"],
        .services-responsive [class*="mb-32"] {
            margin-bottom: 4rem !important;
        }

        .services-responsive [class*="gap-12"],
        .services-responsive [class*="gap-14"] {
            gap: 2rem !important;
        }

        .services-responsive .steps-item > div:last-child {
            min-height: 9rem;
            height: auto !important;
            padding: 3.75rem 1rem !important;
        }

        .services-responsive #steps-carousel {
            flex-wrap: wrap !important;
            justify-content: center !important;
            gap: 2rem !important;
        }

        .services-responsive .steps-item {
            width: calc(50% - 1rem) !important;
            flex: 0 0 calc(50% - 1rem) !important;
        }

        .services-responsive .steps-item h4 {
            font-size: 1.35rem !important;
            line-height: 1.22 !important;
        }

        .services-responsive [class*="w-[250px]"] {
            width: 12rem !important;
        }

        .services-responsive [class*="w-[350px]"],
        .services-responsive .max-w-md {
            max-width: 17rem !important;
        }
    }

    @media (min-width: 1024px) and (max-width: 1279px) {
        .services-responsive > section:first-of-type {
            height: 74vh !important;
            min-height: 560px;
            max-height: 760px;
        }

        .services-responsive > section:first-of-type [class*="h-[120vh]"],
        .services-responsive > section:first-of-type [class*="md:h-[90vh]"] {
            height: 100% !important;
            padding-inline: 2rem;
        }

        .services-responsive > section:first-of-type h1 {
            font-size: 4rem !important;
            line-height: 1.08 !important;
        }

        .services-responsive [class*="md:max-w-[950px]"] {
            max-width: 980px !important;
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }

        .services-responsive > section:not(:first-of-type) {
            padding-top: 5rem !important;
            padding-bottom: 5rem !important;
        }

        .services-responsive [class*="gap-40"] {
            gap: 4rem !important;
        }

        .services-responsive > section:nth-of-type(2) > div > div:not([class*="gap-40"]) {
            flex-direction: column !important;
            gap: 3rem !important;
        }

        .services-responsive > section:nth-of-type(2) > div > div:not([class*="gap-40"]) > div {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-bottom: 0 !important;
        }

        .services-responsive > section:nth-of-type(2) .carousel-item {
            width: calc(50% - 0.75rem) !important;
            min-width: calc(50% - 0.75rem);
        }

        .services-responsive [class*="md:pr-24"],
        .services-responsive [class*="md:pl-24"] {
            padding-left: 3rem !important;
            padding-right: 3rem !important;
        }

        .services-responsive h2 {
            font-size: 2.75rem !important;
            line-height: 1.18 !important;
        }

        .services-responsive h3,
        .services-responsive h4 {
            font-size: 1.5rem !important;
            line-height: 1.25 !important;
        }

        .services-responsive p,
        .services-responsive [class*="text-[18px]"],
        .services-responsive [class*="text-[21.28px]"] {
            font-size: 1rem !important;
            line-height: 1.7 !important;
        }

        .services-responsive [class*="text-[71px]"] {
            font-size: 4rem !important;
        }

        .services-responsive .carousel-item {
            padding: 2rem !important;
        }

        .services-responsive [class*="px-14"],
        .services-responsive [class*="px-10"] {
            padding-left: 3rem !important;
            padding-right: 3rem !important;
        }

        .services-responsive [class*="mb-24"],
        .services-responsive [class*="mb-32"] {
            margin-bottom: 4.5rem !important;
        }

        .services-responsive [class*="gap-12"],
        .services-responsive [class*="gap-14"] {
            gap: 2.5rem !important;
        }

        .services-responsive #steps-carousel {
            gap: 1.25rem !important;
        }

        .services-responsive .steps-item {
            width: calc(33.333% - 0.875rem) !important;
            flex: 0 0 calc(33.333% - 0.875rem) !important;
        }

        .services-responsive .steps-item > div:last-child {
            min-height: 9.5rem;
            height: auto !important;
            padding: 3.75rem 1rem !important;
        }

        .services-responsive .steps-item h4 {
            font-size: 1.3rem !important;
            line-height: 1.22 !important;
        }

        .services-responsive [class*="w-[250px]"] {
            width: 13rem !important;
        }

        .services-responsive [class*="w-[350px]"],
        .services-responsive .max-w-md {
            max-width: 19rem !important;
        }
    }
</style>
@endonce
