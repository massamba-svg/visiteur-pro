tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary": "#135bec",
                "background-light": "#f6f6f8",
                "background-dark": "#101622",
                "card-light": "#ffffff",
                "card-dark": "#182235",
                "text-light": "#0d121b",
                "text-dark": "#ffffff",
                "text-muted-light": "#4c669a",
                "text-muted-dark": "#94a3b8",
                "border-light": "#cfd7e7",
                "border-dark": "#2e3a4e",
                "muted-bg-light": "#e7ebf3",
                "muted-bg-dark": "#1f2937",
            },
            fontFamily: {
                "display": ["Inter", "sans-serif"]
            },
            borderRadius: {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
        },
    },
}