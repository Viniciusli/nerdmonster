"use client"
import Link from 'next/link'
import { useState } from "react";

export default function Home() {
  const [name, setName] = useState('')
  const [numbers, setNumbers] = useState(Array(6).fill(''));
  const [ticketCode, setTicket] = useState('');

  const handleNumbers = (event, index) => {
    const newNumbers = [...numbers];
    newNumbers[index] = event.target.value;
    setNumbers(newNumbers);
  };

  const handleName = (event) => {
    setName(event.target.value);
  };

  const allowOnlyNumbers = (event) => {
    event.target.value = event.target.value.replace(/\D/g, '');
  };

  const handleNumberChange = (index, event) => {
    allowOnlyNumbers(event);
    handleNumbers(event, index);
  };

  const enviar = async (e) => {
    e.preventDefault();

    const formData =
    {
      name: name,
      numbers: numbers
    }

    console.log(formData);
    console.log(JSON.stringify(formData));

    await fetch('http://localhost:8080/api/create-ticket', {
      method: 'POST',
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    })
    .then(response => response.json())
    .then(data => {
      setTicket(data.ticketCode)
    })

  };

  return (
    <main className="flex min-h-screen flex-col items-center justify-between">
      <div className="drawer">
        <input id="my-drawer-3" type="checkbox" className="drawer-toggle" /> 
        <div className="drawer-content flex flex-col">
          {/* Navbar */}
          <div className="w-full navbar bg-base-300">
            <div className="flex-none lg:hidden">
              <label htmlFor="my-drawer-3" className="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" className="inline-block w-6 h-6 stroke-current"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
              </label>
            </div> 
            <div className="flex-1 px-2 mx-2">Loteria</div>
            <div className="flex-none hidden lg:block">
              <ul className="menu menu-horizontal">
                {/* Navbar menu content here */}
                <li><Link href="/">Gerar Ticket</Link></li>
                <li><Link href="/results">Verficar Resultado</Link></li>
              </ul>
            </div>
          </div>
          {/* Page content here */}
          <div className="basis-1/2 flex justify-center">
            <form onSubmit={enviar} className="flex flex-col justify-center p-10 gap-6">
              <div className="form-control max-w-xs">
                <label className="label" htmlFor="name">
                  <span className="label-text">Nome</span>
                </label>
                <input onChange={handleName} type="text" placeholder="Type here" className="input input-bordered w-full max-w-xs" />
              </div>
              <div className="form-control max-w-xs">
                <label className="label" htmlFor="numbers">
                  <span className="label-text">Números</span>
                </label>
                <div className="flex gap-4">
                  {numbers.map((value, index) => (
                    <input
                      key={index}
                      onChange={(event) => handleNumberChange(index, event)}
                      type="text"
                      className="input input-bordered w-full max-w-xs"
                      value={value}
                      maxLength={1}
                    />
                  ))}
                </div>
              </div>
              <button type="submit" className="btn btn-primary">Enviar</button>
            </form>

            <div className="toast toast-center">
              <div className="alert alert-success" id="ticketCode">
                <span>Ticket Code: {ticketCode}</span>
              </div>
            </div>
          </div>
        </div>
        <div className="drawer-side">
          <label htmlFor="my-drawer-3" className="drawer-overlay"></label> 
          <ul className="menu p-4 w-80 h-full bg-base-200">
            {/* Sidebar content here */}
              <li><Link href="/">Gerar Ticket</Link></li>
              <li><Link href="/results">Verficar Resultado</Link></li>
          </ul>
          
        </div>
      </div>
    </main>
  )
}
