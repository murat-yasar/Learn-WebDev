import styles from './styles.module.css'

import React from 'react'
import Input from '../Input'
import List from '../List'
import Menu from '../Menu'

function Main() {
  return (
    <div className='main'>
      <Input />
      <List />
      <Menu />
    </div> 
  )
}

export default Main