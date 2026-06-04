'use client'
import { useState, useCallback, useEffect } from 'react'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'

const testimonials = [
  {
    name: 'Satisfied Customer',
    designation: 'Student',
    content: 'Fonet Stationary Center provides excellent thesis typing and printing services. Their quality and quick turnaround time is unmatched in Chitwan. Highly recommended for all students!',
    image: '/images/testimonial1.jpg',
  },
  {
    name: 'Business Client',
    designation: 'Entrepreneur',
    content: 'We have been using FCI for all our business printing needs including visiting cards, flex prints, and document services. Professional service at affordable prices.',
    image: '/images/testimonial2.jpg',
  },
  {
    name: 'Regular Customer',
    designation: 'Teacher',
    content: 'I have been going to Fonet Stationary for all my documentation needs. Their team is professional, prices are reasonable, and they always deliver on time.',
    image: '/images/testimonial3.jpg',
  },
]

export default function TestimonialSection() {
  const [current, setCurrent] = useState(0)

  const next = useCallback(() => setCurrent((p) => (p + 1) % testimonials.length), [])
  const prev = () => setCurrent((p) => (p - 1 + testimonials.length) % testimonials.length)

  useEffect(() => {
    const timer = setInterval(next, 6000)
    return () => clearInterval(timer)
  }, [next])

  const prevIdx = (current - 1 + testimonials.length) % testimonials.length
  const nextIdx = (current + 1) % testimonials.length

  return (
    <div className="testimonials-area" id="testimonials">
      <div className="container">
        <section>
          <AnimateOnScroll>
            <div className="customer-feedback">
              <div className="container">
                <div className="head_white head_center">
                  <div className="title-dot"></div>
                  <div className="section-title">
                    <div className="sub-title">OUR</div>
                    <h2>TESTIMONIAL</h2>
                  </div>
                </div>
              </div>

              <div className="col-md-8 col-md-offset-2 col-sm-12">
                <div className="feedback-slider">
                  <div className="feedback-slider-item" style={{ display: 'flex' }}>
                    <div className="col-md-5 pd-0" style={{ position: 'relative' }}>
                      <div className="img-overlay"></div>
                      <img className="img-responsive" src={testimonials[current].image} alt={testimonials[current].name} />
                    </div>
                    <div className="col-md-7 pd-0">
                      <div className="quote">
                        <p>{testimonials[current].content}</p>
                        <div className="clearfix"></div>
                        <h3 className="customer-name">{testimonials[current].name}</h3>
                        <div className="text-designation">({testimonials[current].designation})</div>
                      </div>
                    </div>
                    <div className="clearfix"></div>
                  </div>
                </div>

                {/* Thumbnail navigation */}
                <div className="feedback-slider-thumb hidden-xs">
                  <div className="thumb-prev" onClick={prev}>
                    <span>Previous</span>
                    <div className="img-overlay1"></div>
                    <img className="img-responsive" src={testimonials[prevIdx].image} alt="" />
                  </div>
                  <div className="thumb-next" onClick={next}>
                    <span>Next</span>
                    <div className="img-overlay2"></div>
                    <img className="img-responsive" src={testimonials[nextIdx].image} alt="" />
                  </div>
                </div>

                {/* Arrow navigation */}
                <div className="testimonial-nav">
                  <button onClick={prev} aria-label="Previous testimonial">
                    <i className="fa fa-long-arrow-left"></i>
                  </button>
                  <button onClick={next} aria-label="Next testimonial">
                    <i className="fa fa-long-arrow-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </AnimateOnScroll>
        </section>
      </div>
    </div>
  )
}
