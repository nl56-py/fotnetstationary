'use client'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'

const features = [
  { 
    icon: 'fa fa-print', 
    title: 'Satisfied Service', 
    text: 'It is a long established fact that a reader will distracted.' 
  },
  { 
    icon: 'fa fa-book', 
    title: 'Booklet Printing', 
    text: 'It is a long established fact that a reader will distracted.' 
  },
  { 
    icon: 'fa fa-star', 
    title: 'Quality Paints', 
    text: 'It is a long established fact that a reader will distracted.' 
  },
  { 
    icon: 'fa fa-check', 
    title: 'Fast Service', 
    text: 'It is a long established fact that a reader will distracted.' 
  },
]

export default function FeaturesSection() {
  return (
    <section id="features-section" className="ht-section features-area">
      <div className="sec-overlay"></div>
      <div className="container">
        <AnimateOnScroll className="col-md-6 col-sm-12 col-xs-12 pd-">
          <div className="features-title-container">
            <div className="features-subtitle-our">OUR</div>
            <div className="features-title-bracket-wrapper">
              <span className="features-title-text">
                FEATURE
                <span className="title-red-dot"></span>
              </span>
            </div>
          </div>
          <div className="clearfix"></div>
          <p className="featuretext">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Quis ipsum suspendisse ultrices gravida.
            Risus commodo viverra maecenas accumsan lacus vel
            facilisis. Lorem ipsum dolor sit amet, consectetur
            adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Quis ipsum suspendisse
            ultrices gravida. Risus ccumsan lacus vel facilisis.
          </p>
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
