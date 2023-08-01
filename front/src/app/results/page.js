"use client"
import Link from 'next/link'
import { useState } from "react";

export default function Results() {
    const [ticketCode, setTicket] = useState('')
    const [message, setMessage] = useState('')

    const handleTicket = (event) => {
        setTicket(event.target.value);
    };

    const enviar = async (e) => {
        e.preventDefault();
        
        await fetch('http://localhost:8080/api/ticket/'+ticketCode, {
          method: 'GET',
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then(response => response.json())
        .then(data => {
          setMessage(data.message)
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
                <div className="flex justify-center p-10 gap-6">
                    <form onSubmit={enviar} className="flex flex-col form-control max-w-xs">
                        <div className="form-control max-w-xs">
                            <label className="label">
                                <span className="label-text">Ticket Code</span>
                            </label>
                            <input onChange={handleTicket} name="ticket" type="text" placeholder="Type here" className="input input-bordered w-full max-w-xs" />
                        </div>

                        <button type="submit" className="btn btn-primary">Enviar</button>
                    </form>

                    <div className="toast toast-center">
                        <div className="alert alert-success" id="ticketCode">
                            <span>{message}</span>
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