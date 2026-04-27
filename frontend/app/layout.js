import { Inter } from "next/font/google";
import "./globals.css";

const inter = Inter({
  variable: "--font-inter",
  subsets: ["latin"],
});

export const metadata = {
  title: "SMK DWIGUNA - Official Website",
  description: "Mendidik generasi unggul yang siap kerja di bidang teknologi informasi bersama SMK DWIGUNA Depok.",
  icons: {
    icon: '/dwiguna.png',
  },
};

export default function RootLayout({ children }) {
  return (
    <html lang="id" className={`scroll-smooth ${inter.variable}`}>
      <body
        className="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased selection:bg-orange-500 selection:text-white font-sans min-h-full flex flex-col"
      >
        {children}
      </body>
    </html>
  );
}
