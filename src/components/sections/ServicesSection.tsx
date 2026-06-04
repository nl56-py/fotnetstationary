'use client'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'

const services = [
  { title: 'Thesis Typing', slug: 'thesis-typing', icon: 'fa fa-keyboard-o', image: '/images/service-thesis-typing.jpg' },
  { title: 'Best Photocopy', slug: 'photocopy-center', icon: 'fa fa-copy', image: '/images/service-photocopy.jpg' },
  { title: 'Stationary', slug: 'stationary', icon: 'fa fa-pencil', image: '/images/servicesimg.jpg' },
  { title: 'General Typing', slug: 'general-typing', icon: 'fa fa-file-text-o', image: '/images/service-thesis-typing.jpg' },
  { title: 'Documentations', slug: 'documentations', icon: 'fa fa-folder-open-o', image: '/images/servicesimg.jpg' },
  { title: 'Students Materials', slug: 'students-materials', icon: 'fa fa-graduation-cap', image: '/images/servicesimg.jpg' },
  { title: 'Courier Services', slug: 'courier-services', icon: 'fa fa-truck', image: '/images/servicesimg.jpg' },
  { title: 'Others', slug: 'color-print', icon: 'fa fa-ellipsis-h', image: '/images/service-color-print.jpg' },
]

export default function ServicesSection() {
  return (
    <div className="service-area" id="service">
      <div className="container">
        <div className="head_white head_center">
          <div className="title-dot"></div>
          <div className="section-title">
            <div className="sub-title">OUR</div>
            <h2>SERVICES</h2>
          </div>
        </div>
      </div>
      <div className="clearfix"></div>
      <div className="container">
        <div className="row service-padding">
          {services.map((service, idx) => (
            <AnimateOnScroll
              key={idx}
              className="col-md-3 col-sm-6 col-xs-12 service-mainbox"
              duration="0.6s"
            >
              <div className="single-service-bx">
                <a href={`/services/${service.slug}`}>
                  <img className="img-responsive" src={service.image} alt={service.title} />
                </a>
                <div className="clearfix"></div>
                <div className="service-title-box">
                  <div className="service-icon">
                    <i className={service.icon} aria-hidden="true"></i>
                  </div>
                  <a href={`/services/${service.slug}`}>
                    <h4 className="inner-area-title">{service.title}</h4>
                  </a>
                </div>
              </div>
            </AnimateOnScroll>
          ))}
        </div>
      </div>
    </div>
  )
}
