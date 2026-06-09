import type { Metadata } from "next";
import "./globals.css";
import { AuthProvider } from "@/context/AuthContext";

export const metadata: Metadata = {
  metadataBase: new URL("https://fonet.com.np"),
  title: "Fonet Stationary Center - Today Write's for Tomorrow",
  description: "Fonet Stationary Center (FCI) at Bharatpur, Chitwan offers expert thesis typing, high-speed photocopying, notary and certified translation, PVC cards, visiting cards, custom printing, and study materials.",
  keywords: "stationary Chitwan, printing Bharatpur, photocopy Saptagandaki, thesis typing Chitwan, notary translation Bharatpur, document attestation Nepal, PVC ID card Chitwan, visiting card print Bharatpur, flex print Chitwan, self stamp Chitwan, book binding Bharatpur, academic notes SEE",
  authors: [{ name: "Shubarna Neupane" }],
  robots: {
    index: true,
    follow: true,
    googleBot: {
      index: true,
      follow: true,
      'max-video-preview': -1,
      'max-image-preview': 'large',
      'max-snippet': -1,
    },
  },
  alternates: {
    canonical: "https://fonet.com.np/",
    languages: {
      "en": "https://fonet.com.np/?lang=en",
      "ne": "https://fonet.com.np/?lang=ne",
      "x-default": "https://fonet.com.np/",
    },
  },
  icons: {
    icon: [
      { url: "/images/favicon.ico", sizes: "any" },
      { url: "/images/favicon-16x16.png", sizes: "16x16", type: "image/png" },
      { url: "/images/favicon-32x32.png", sizes: "32x32", type: "image/png" },
    ],
    apple: "/images/apple-touch-icon.png",
  },
  openGraph: {
    title: "Fonet Stationary Center - Today Write's for Tomorrow",
    description: "Your one-stop printing, document preparation, and certified notary translation solution in Bharatpur, Chitwan. Serving students and businesses since 2070 B.S.",
    url: "https://fonet.com.np/",
    siteName: "Fonet Stationary Center",
    locale: "en_US",
    type: "website",
    images: [
      {
        url: "/images/fonet logo.PNG",
        width: 1200,
        height: 630,
        alt: "Fonet Stationary Center Logo - Bharatpur, Chitwan",
      },
    ],
  },
  twitter: {
    card: "summary_large_image",
    title: "Fonet Stationary Center - Today Write's for Tomorrow",
    description: "Fonet Stationary Center (FCI) offers professional typing, printing, lamination, certified notary translation, and stationary in Bharatpur, Chitwan.",
    images: ["/images/fonet logo.PNG"],
  },
  other: {
    "geo.region": "NP-3",
    "geo.placename": "Bharatpur",
    "geo.position": "27.6629;84.3826",
    "ICBM": "27.6629, 84.3826",
    "DC.title": "Fonet Stationary Center - Printing & Notary Services in Bharatpur Chitwan",
    "DC.creator": "Shubarna Neupane",
    "DC.subject": "Stationary, Printing, Photocopy, Notary Translation, Academic Typing, PVC Card, Visiting Card",
    "DC.description": "Leading stationary and document services center in Bharatpur, Chitwan, Nepal. Offering typing, printing, photocopy, lamination, visiting cards, PVC cards, and notary translation.",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="anonymous" />
        <link
          href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap"
          rel="stylesheet"
        />
        <link
          href="https://fonts.googleapis.com/css2?family=Yeseva+One&display=swap"
          rel="stylesheet"
        />
        <link
          href="https://fonts.googleapis.com/css2?family=Concert+One&family=Kaisei+HarunoUmi:wght@400;500;700&display=swap"
          rel="stylesheet"
        />
        <link
          href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
          rel="stylesheet"
        />
        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />
        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        />
      </head>
      <body>
        <AuthProvider>
          {children}
        </AuthProvider>
      </body>
    </html>
  );
}
