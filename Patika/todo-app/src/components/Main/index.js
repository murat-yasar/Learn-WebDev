import React from 'react'

import styles from './styles.module.css'

import Input from '../Input'
import List from '../List'
import Menu from '../Menu'

function Main() {
  return (
    <div className={styles.main}>
      <Input />
      <List />
      <Menu />
    </div>
  )
}

export default Main