'use client'
import { useEffect, useRef, useState } from 'react'

const stats = [
  { icon: 'fa fa-smile-o', count: 5000, title: 'HAPPY CUSTOMERS' },
  { icon: 'fa fa-check-circle', count: 12000, title: 'PROJECTS COMPLETED' },
  { icon: 'fa fa-calendar', count: 10, title: 'YEARS EXPERIENCE' },
  { icon: 'fa fa-cogs', count: 17, title: 'SERVICES OFFERED' },
]

function Counter({ target, started }: { target: number; started: boolean }) {
  const [count, setCount] = useState(0)

  useEffect(() => {
    if (!started) return
    let current = 0
    const increment = target / 100
    const timer = setInterval(() => {
      current += increment
      if (current >= target) {
        setCount(target)
        clearInterval(timer)
      } else {
        setCount(Math.ceil(current))
      }
    }, 20)
    return () => clearInterval(timer)
  }, [started, target])

  return <>{count.toLocaleString()}</>
}

export default function CounterSection() {
  const ref = useRef<HTMLDivElement>(null)
  const [started, setStarted] = useState(false)

  useEffect(() => {
    if (!ref.current) return
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setStarted(true)
          observer.disconnect()
        }
      },
      { threshold: 0.3 }
    )
    observer.observe(ref.current)
    return () => observer.disconnect()
  }, [])

  return (
    <div className="counter-area" id="counter" ref={ref}>
      <div className="ovly"></div>
      <div className="container">
        <div className="counter-single-area">
          <div className="row">
            {stats.map((stat, idx) => (
              <div key={idx} className="col-md-3 col-sm-6 col-xs-12 couneter-box">
                <div className="cd-single">
                  <div className="count-box">
                    <div className="Col-xl-5 col-md-5 col-sm-5 col-xs-12 pd-0">
                      <div className="cd-icon">
                        <i className={`${stat.icon} fill-gradient-icon`}></i>
                      </div>
                    </div>
                    <div className="Col-xl-7 col-md-7 col-sm-7 col-xs-12 pd-0">
                      <div className="cd-num inner-area-title">
                        <Counter target={stat.count} started={started} />
                      </div>
                    </div>
                  </div>
                  <div className="cd-title inner-area-title">{stat.title}</div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  )
}
