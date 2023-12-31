import { Button, Form } from "react-bootstrap";
import classes from "./formulario.module.css";
import { useState } from "react";

export default function Formulario() {
    const [user, setUser] = useState<string | null>(null);
    const [password, setPassword] = useState<string | null>(null);

    const handleInputUser = (e: React.ChangeEvent<HTMLInputElement>) => {
        //TODO adicionar validação ao digitar o input, o valor vai ser cpf então vai ser interessante colocar uma mask para cpf e valores numericos
        setUser(e.currentTarget.value);
    }
    const handleInputPassoword = (e: React.ChangeEvent<HTMLInputElement>) => {
        setPassword(e.currentTarget.value);
    }

    /**
     * Adicionar o AXIOS para fazer requisição, fiquei meio triste com esse frontend mas é o que ta tendo por enquanto
     */

    return (
        <div >
            <h3>Bem vindo ao Login</h3>
            <Form>
                <Form.Group>
                    <Form.Label>Usuário</Form.Label>
                    <Form.Control onChange={handleInputUser} type="text"></Form.Control>
                </Form.Group>
                <Form.Group>
                    <Form.Label>Senha</Form.Label>
                    <Form.Control onChange={handleInputPassoword} type="text"></Form.Control>
                </Form.Group>
                <Button variant="success" className="mt-3">Login</Button>
            </Form>
        </div>

    )
}