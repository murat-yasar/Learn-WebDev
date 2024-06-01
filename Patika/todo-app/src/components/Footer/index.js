import styles from './styles.module.css'

import React from 'react'

function Footer() {
  let date = new Date();
  let today = {
    day: date.getDate(),
    month: date.getMonth()+1,
    year: date.getFullYear()
  }

  return (
    <footer className={styles.footer}>
      <p>Developed by <a href="https://github.com/murat-yasar">Murat Yaşar</a>, {today.year}</p>
    </footer>
  )
}

export default Footer