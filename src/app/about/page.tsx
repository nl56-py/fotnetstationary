import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'

export default function AboutPage() {
  return (
    <div>
      <Header />

      <div className="inner-banner">
        <div className="container">
          <h1>About Us</h1>
          <ul className="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>About Us</li>
          </ul>
        </div>
      </div>

      <div className="about-area" style={{ paddingTop: 60 }}>
        <div className="container">
          <div className="row">
            <div className="col-md-6 col-sm-12">
              <div className="section-title" style={{ marginBottom: 20 }}>
                <div className="sub-title">ABOUT US</div>
                <h2>FONET STATIONARY CENTER</h2>
              </div>
              <p style={{ color: '#666', lineHeight: 1.8, fontSize: 15 }}>
                Fonet Stationary Center (FCI) is located at central location of Bharatpur,
                in front of Saptagandaki Campus. We are here to cater you all required services
                for Computer such as typing, printing, photocopy and other related tasks.
              </p>
              <p style={{ color: '#666', lineHeight: 1.8, fontSize: 15 }}>
                FCI was established in 2070 B.S. We have earned trust of people from all Chitwan
                and neighbor for quality and quick service. Fonet Stationary Center is Business
                Enterprise, is a registered and licensed business enterprise in the Business Service Centers.
              </p>

              <div style={{ marginTop: 30 }}>
                <h4 style={{ color: '#3347B0', marginBottom: 15 }}>Our Mission</h4>
                <p style={{ color: '#666', lineHeight: 1.8, fontSize: 15 }}>
                  Our mission is to establish a standard business services center cum copy shop that will
                  make available a wide range of services and products at affordable prices.
                </p>
              </div>

              <div style={{ marginTop: 25 }}>
                <h4 style={{ color: '#3347B0', marginBottom: 15 }}>Our Vision</h4>
                <p style={{ color: '#666', lineHeight: 1.8, fontSize: 15 }}>
                  Our vision is to build a business services center cum copy shop that will have active
                  presence all over major locations.
                </p>
              </div>
            </div>
            <div className="col-md-6 col-sm-12">
              <img src="/images/About3.jpg" alt="About FCI" style={{ width: '100%', borderRadius: 10, boxShadow: '0 10px 30px rgba(0,0,0,0.1)' }} />

              <div style={{ marginTop: 30, background: '#f8f9fa', borderRadius: 10, padding: 25 }}>
                <h4 style={{ color: '#222', marginBottom: 20 }}>Our Team</h4>
                {[
                  { name: 'Shubarna Neupane', position: 'Managing Director' },
                  { name: 'Ranjana Poudel Neupane', position: 'Co-Manager' },
                  { name: 'Tapesh Mahato', position: 'Operations' },
                ].map((member, idx) => (
                  <div key={idx} style={{ display: 'flex', alignItems: 'center', gap: 15, marginBottom: 15, padding: 12, background: '#fff', borderRadius: 8 }}>
                    <div style={{ width: 45, height: 45, background: 'linear-gradient(135deg, #3347B0, #5b6fd6)', borderRadius: '50%', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#fff', fontWeight: 700, fontSize: 18 }}>
                      {member.name[0]}
                    </div>
                    <div>
                      <div style={{ fontWeight: 600, color: '#222', fontSize: 15 }}>{member.name}</div>
                      <div style={{ color: '#888', fontSize: 13 }}>{member.position}</div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}
