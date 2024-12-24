import dotenv from 'dotenv';
import esbuild from 'esbuild';
import { sassPlugin } from 'esbuild-sass-plugin';
import path from 'path';

// Load environment variables from .env file
dotenv.config();

/**
 * The path to the theme's directory.
 */
const themePath: string = path.join('wp_data', 'wp-content', 'themes', process.env.THEME_NAME || '');

/**
 * Entry points for the project.
 */
const entryPoints: Record<string, string> = {
    'css/style': path.join(themePath, 'css', 'src', 'main.scss'),
    'js/main': path.join(themePath, 'js', 'src', 'main.tsx'),
};

/**
 * Builds the project using esbuild, optionally enabling watch mode.
 * 
 * @param {boolean} watch - Whether to enable watch mode.
 * @returns {Promise<void>} Resolves when the build is complete.
 */
const build = async (watch: boolean = false): Promise<void> => {
    try {
        const context = await esbuild.context({
            entryPoints,
            outdir: path.join(themePath, 'dist'),
            plugins: [sassPlugin()],
            minify: true,
            sourcemap: true,
            bundle: true,
            loader: { '.tsx': 'tsx', '.ts': 'ts' },
            splitting: false,
            format: 'esm',
        });

        if (watch) {
            console.log('👀 Watching for changes...');
            await context.watch();
        } else {
            console.log('✅ Build completed.');
            await context.rebuild();
            await context.dispose();
        }
    } catch (error) {
        console.error('❌ Build failed:', error);
        process.exit(1);
    }
};

/**
 * Determines if the script is running in watch mode by checking command-line arguments.
 */
const isWatchMode: boolean = process.argv.includes('--watch');

// Run the build process
build(isWatchMode);
