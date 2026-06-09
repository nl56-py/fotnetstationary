'use client'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'

export default function ContactInfoSection() {
  return (
    <div id="appointment">
      <div className="container">
        <div className="row">
          <AnimateOnScroll className="col-md-6 col-sm-12 col-xl-6 appback">
            <div className="app-rhsbx">
              <div className="app-rhsbxinn">
                <h2>CONTACT<br />INFO</h2>
                <img className="titlt-image" src="/images/ornaments4.png" alt="" />
                <div className="clearfix"></div>
              </div>
              <div className="gg-shape-triangle">
                <img src="/images/shape-triangle.png" alt="" />
              </div>
              <p>
                At Fonet Stationary Center, we handle all kinds of business services like typing, 
                printing, laminating, photocopying, scanning, and other office support services. 
                We carry out extensive feasibility studies to make sure that we stand out with 
                quality services and competitive rates.
              </p>
              <div className="clearfix"></div>
            </div>
          </AnimateOnScroll>

          <AnimateOnScroll className="col-md-6 col-sm-12 col-xl-6">
            <div className="info-detailsbox">
              <div className="info-title">CONTACT US</div>
              <div className="info-box">
                <i className="fa fa-phone" aria-hidden="true"></i>
                056-526307 | 9845220077 | 9765028501 | 9765028500
              </div>
              <div className="clearfix"></div>
            </div>

            <div className="info-detailsbox1">
              <div className="info-title1">EMAIL</div>
              <div className="info-box1">
                <i className="fa fa-envelope-o" aria-hidden="true"></i>
                fcichitwan@gmail.com
              </div>
              <div className="clearfix"></div>
            </div>

            <div className="info-detailsbox2">
              <div className="info-title2">ADDRESS</div>
              <div className="info-box2">
                <i className="fa fa-map-marker" aria-hidden="true"></i>
                <p className="addressdoc">Bharatpur Metropolitan City Ward No.10, Saptagandaki Chowk, Chitwan, Nepal</p>
              </div>
              <div className="clearfix"></div>
            </div>
          </AnimateOnScroll>
        </div>
        <div className="clearfix"></div>
      </div>
      <img className="secbottom-image" src="/images/contactinfobg.png" alt="" />
      <div className="clearfix"></div>
    </div>
  )
}

