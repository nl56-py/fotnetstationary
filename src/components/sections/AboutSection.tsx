'use client'
import { useState } from 'react'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'

const aboutFeatures = [
  { icon: 'fa fa-asterisk', title: 'Satisfied Service', text: 'Quality services with quick turnaround and customer satisfaction guaranteed.' },
  { icon: 'fa fa-star-o', title: 'Trusted Quality', text: 'Earning trust from all over Chitwan since 2070 B.S. with consistent quality.' },
]

const sliderFeatures = [
  { icon: 'fa fa-print', title: 'Printing Solutions' },
  { icon: 'fa fa-copy', title: 'Photocopy Center' },
  { icon: 'fa fa-file-text-o', title: 'Typing Services' },
  { icon: 'fa fa-shopping-bag', title: 'Stationary Items' },
]

export default function AboutSection() {
  const [startIndex, setStartIndex] = useState(0)

  const handlePrev = () => {
    setStartIndex((prev) => (prev - 1 + sliderFeatures.length) % sliderFeatures.length)
  }

  const handleNext = () => {
    setStartIndex((prev) => (prev + 1) % sliderFeatures.length)
  }

  const displayedFeatures = [
    sliderFeatures[startIndex % sliderFeatures.length],
    sliderFeatures[(startIndex + 1) % sliderFeatures.length],
    sliderFeatures[(startIndex + 2) % sliderFeatures.length],
  ]

  return (
    <div className="about-section-custom" id="about">
      <div className="container">
        <div className="about-row-custom">
          {/* Left Column */}
          <AnimateOnScroll className="about-left-col">
            <div>
              <div className="sub-title">ABOUT US</div>
              <h2>Fonet Stationary Center</h2>
              <div className="about-description">
                Fonet Stationary Center (FCI) is located at central location of Bharatpur, in front of
                Saptagandaki Campus. We are here to cater you all required services for Computer such as
                typing, printing, photocopy and other related tasks.
                <br /><br />
                FCI was established in 2070 B.S. We have earned trust of people from all Chitwan and
                neighbor for quality and quick service. Fonet Stationary Center is a registered and
                licensed business enterprise in the Business Service Centers.
              </div>

              {/* Vertical Features List */}
              <div className="about-features-list">
                {aboutFeatures.map((feature, idx) => (
                  <div key={idx} className="about-feature-item">
                    <div className="about-feature-icon-wrapper">
                      <div className="about-feature-icon-outer" />
                      <div className="about-feature-icon-inner">
                        <i className={feature.icon} />
                      </div>
                    </div>
                    <div className="about-feature-text-wrapper">
                      <h4>{feature.title}</h4>
                      <p>{feature.text}</p>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            {/* Bottom Slider Box */}
            <div className="about-bottom-slider-container">
              <div className="about-blue-card">
                {displayedFeatures.map((feature, idx) => (
                  <div key={`${feature.title}-${idx}`} className="about-slider-item">
                    <div className="about-slider-icon-circle">
                      <i className={feature.icon} />
                    </div>
                    <div className="about-slider-label">{feature.title}</div>
                  </div>
                ))}
              </div>
              <div className="about-nav-panel">
                <button 
                  onClick={handlePrev} 
                  className="about-nav-button" 
                  aria-label="Previous service"
                  type="button"
                >
                  <i className="fa fa-chevron-left" />
                </button>
                <button 
                  onClick={handleNext} 
                  className="about-nav-button" 
                  aria-label="Next service"
                  type="button"
                >
                  <i className="fa fa-chevron-right" />
                </button>
              </div>
            </div>
          </AnimateOnScroll>

          {/* Right Column */}
          <AnimateOnScroll className="about-right-col">
            <img alt="About Fonet Stationary Center" src="/images/About3.jpg" />
          </AnimateOnScroll>
        </div>
      </div>
    </div>
  )
}
