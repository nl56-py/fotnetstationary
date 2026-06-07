'use client'
import React from 'react'

const reviews = [
  {
    name: 'Shubham Sharma',
    avatar: 'SS',
    rating: 5,
    date: '2 weeks ago',
    text: 'Fonet has been my go-to for thesis typing and print jobs throughout college. Shubarna and the team are fast, highly professional, and ensure zero typos. Fully satisfied!',
    bg: '#3f51b5'
  },
  {
    name: 'Alina Poudel',
    avatar: 'AP',
    rating: 5,
    date: '1 month ago',
    text: 'Excellent translation service! Needed my academic documents attested and translated from Nepali to English. They did it accurately and in record time. Excellent staff.',
    bg: '#e91e63'
  },
  {
    name: 'Ramesh Adhikari',
    avatar: 'RA',
    rating: 5,
    date: '3 weeks ago',
    text: 'Best photocopy and flex printing service in Chitwan. The quality is extremely sharp, and their pricing is very reasonable for bulk orders. 5 stars!',
    bg: '#4caf50'
  },
  {
    name: 'Nikita Sen',
    avatar: 'NS',
    rating: 5,
    date: '3 days ago',
    text: 'Super friendly staff and extremely fast delivery of custom printed cups and badges for our event. Highly recommend Fonet Stationery Center!',
    bg: '#ff9800'
  },
  {
    name: 'David Wilson',
    avatar: 'DW',
    rating: 5,
    date: '2 months ago',
    text: "I've tried multiple document writing and lamination shops in Bharatpur, but Fonet stands out. Their attention to detail in binding and presentation is unmatched.",
    bg: '#009688'
  },
  {
    name: 'Pooja Shrestha',
    avatar: 'PS',
    rating: 5,
    date: '5 days ago',
    text: 'Great customer service! I submitted my document translation request online and got it ready within a few hours. The process is completely seamless and efficient.',
    bg: '#795548'
  }
]

export default function GoogleReviews() {
  return (
    <section className="google-reviews-section">
      <div className="container">
        {/* Header Area */}
        <div className="reviews-header-block">
          <div className="google-brand">
            <span className="g-blue">G</span>
            <span className="g-red">o</span>
            <span className="g-yellow">o</span>
            <span className="g-blue">g</span>
            <span className="g-green">l</span>
            <span className="g-red">e</span>
            <span className="brand-suffix"> Reviews</span>
          </div>
          
          <div className="rating-summary">
            <div className="stars-row">
              <span className="rating-val">4.9</span>
              <div className="stars-gold">
                <i className="fa fa-star"></i>
                <i className="fa fa-star"></i>
                <i className="fa fa-star"></i>
                <i className="fa fa-star"></i>
                <i className="fa fa-star-half-o"></i>
              </div>
            </div>
            <p className="rating-subtitle">Based on 342 verified customer reviews</p>
          </div>

          <a 
            href="https://www.google.com/maps?cid=13143640243453316314" 
            target="_blank" 
            rel="noopener noreferrer" 
            className="write-review-btn"
          >
            <i className="fa fa-google" style={{ marginRight: 8 }}></i>
            Write a Review
          </a>
        </div>

        {/* Scrolling Marquee Container */}
        <div className="marquee-wrapper">
          <div className="marquee-content animate-marquee">
            {/* Double the list to create a seamless infinite loop */}
            {[...reviews, ...reviews].map((rev, idx) => (
              <div className="review-card" key={idx}>
                <div className="card-top">
                  <div className="reviewer-avatar" style={{ backgroundColor: rev.bg }}>
                    {rev.avatar}
                  </div>
                  <div className="reviewer-meta">
                    <h4 className="reviewer-name">{rev.name}</h4>
                    <span className="review-date">{rev.date}</span>
                  </div>
                  <div className="verified-badge">
                    <i className="fa fa-check-circle" title="Verified Customer"></i>
                  </div>
                </div>
                
                <div className="stars-row-card">
                  {[...Array(rev.rating)].map((_, i) => (
                    <i className="fa fa-star" key={i}></i>
                  ))}
                </div>

                <p className="review-text">{rev.text}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
