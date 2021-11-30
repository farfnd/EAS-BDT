module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins"],
                arial: ["Arial"],
            },
            minWidth: {
                28: "7rem",
                "1/2vw": "1/2vw",
            },
            minHeight: {
                28: "7rem",
                32: "8rem",
                "1/4vh": "25vh",
                "1/2vh": "50vh",
                "3/4vh": "75vh",
            },
            maxWidth: {
                "2xs": "16rem",
                "3xs": "12rem",
                "1/2vw": "1/2vw",
            },
            boxShadow: {
                'custom1': "0 2px 6px 0 rgba(0, 0, 0, 0.25)",
            },
        },
        letterSpacing: {
            widest: "0.3em",
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
};
