import { createVuetify } from 'vuetify';

const vuetify = createVuetify({
    theme: {
        defaultTheme: 'light',
        themes: {
            light: {
                colors: {
                    primary: '#457a5f',
                    secondary: '#a0522d',
                    accent: '#d2b48c',
                    background: '#f5f5dc',
                    surface: '#ffffff'
                },
            },
            dark: {
                colors: {
                    primary: '#39634d',
                    secondary: '#8b4513',
                    accent: '#deb887',
                    background: '#2e2e2e',
                    surface: '#424242'
                }
            }
        }
    }
});

export default vuetify;