'use client'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'

const features = [
  { 
    icon: 'fa fa-print', 
    title: 'Complete Print Support', 
    text: 'From photocopy and laser print work to lamination and binding, we handle documents with care.' 
  },
  { 
    icon: 'fa fa-book', 
    title: 'Academic Assistance', 
    text: 'Students can rely on us for thesis typing, formatting, printing, and study-material preparation.' 
  },
  { 
    icon: 'fa fa-star', 
    title: 'Professional Quality', 
    text: 'We use dependable equipment and materials to produce clean, readable, and durable results.' 
  },
  { 
    icon: 'fa fa-check', 
    title: 'Fast Local Service', 
    text: 'Our Bharatpur team keeps routine typing, copying, and printing jobs moving quickly.' 
  },
]

export default function FeaturesSection() {
  return (
    <section id="features-section" className="ht-section features-area">
      <div className="sec-overlay"></div>
      <div className="container">
        <div className="features-title-container">
          <div className="features-subtitle-our">OUR</div>
          <div className="features-title-bracket-wrapper">
            <span className="features-title-text">
              FEATURE
              <span className="title-red-dot"></span>
            </span>
          </div>
        </div>
        
        <AnimateOnScroll className="col-md-6 col-sm-12 col-xs-12 pd-">
          <p className="featuretext">
            Fonet Stationary Center supports students, offices, and local
            customers with practical document services in one place. Our team
            prepares typed documents, photocopies, color prints, lamination,
            academic materials, stationery, and related office work with a focus
            on accuracy, clear presentation, and timely service.
          </p>
          <div className="features-highlights-list">
            <div className="feature-highlight-item">
              <div className="highlight-icon"><i className="fa fa-flash"></i></div>
              <div className="highlight-content">
                <h5>Fast Local Turnaround</h5>
                <p>Routine typing, copying, and printing jobs are processed with speed and accuracy.</p>
              </div>
            </div>
            <div className="feature-highlight-item">
              <div className="highlight-icon"><i className="fa fa-star"></i></div>
              <div className="highlight-content">
                <h5>Professional Grade Quality</h5>
                <p>We use state-of-the-art equipment to ensure clean, durable, and presentation-ready output.</p>
              </div>
            </div>
            <div className="feature-highlight-item">
              <div className="highlight-icon"><i className="fa fa-heart"></i></div>
              <div className="highlight-content">
                <h5>Trusted Chitwan Partner</h5>
                <p>Earning community trust since 2070 B.S. by prioritizing customer satisfaction.</p>
              </div>
            </div>
          </div>
        </AnimateOnScroll>
        
        <div className="col-md-6 col-sm-12 col-xs-12 pd-">
          <div className="features-inn">
            {features.map((feature, idx) => (
              <AnimateOnScroll key={idx} className="mainodev" animation="zoom-in" duration="0.8s">
                <div className={`mem-inn-card feature-card-${idx}`}>
                  <div className="card-header-color"></div>
                  <div className="card-body-content">
                    <div className="sec-icn">
                      <a href="/services">
                        <span className={feature.icon}></span>
                      </a>
                    </div>
                    <div className="features-content">
                      <a href="/services">
                        <h3 className="inner-area-title">{feature.title}</h3>
                      </a>
                      <p>{feature.text}</p>
                    </div>
                  </div>
                  <div className="clearfix"></div>
                </div>
              </AnimateOnScroll>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
