import type { Metadata } from "next";
import "./globals.css";

export const metadata: Metadata = {
  title: "Fonet Stationary Center - Today Write's for Tomorrow",
  description: "Fonet Stationary Center (FCI) is located at Bharatpur, Chitwan. We offer typing, printing, photocopy, lamination, flex print, visiting cards, PVC cards, and more.",
  keywords: "printing, photocopy, typing, stationary, Bharatpur, Chitwan, Nepal, FCI, Fonet",
  openGraph: {
    title: "Fonet Stationary Center",
    description: "Your one-stop printing and stationary solution in Bharatpur, Chitwan",
    type: "website",
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
        {children}
      </body>
    </html>
  );
}
