import { Button, Image, Stack } from "react-bootstrap";
import { ReactElement } from "react";
import { Calendar, Info, InfoCircle, ListTask, Newspaper } from "react-bootstrap-icons";

interface MenuButtonProps {
    text: string;
    icon: ReactElement;
}

export default function MenuLateral() {
    return (
        <div className="border border-2 p-3" style={{ width: "200px", height: "100%" }}>
            <Stack gap={3} direction="vertical">
                <div>
                    <div>
                        <Image src="../../../public/icon_teste.jpg" roundedCircle fluid />
                    </div>
                    <h4 className="fw-bold">Vitor Khaled</h4>
                    <hr />

                    <Stack gap={3} direction="vertical" className="">
                        {renderButton({ text: "Tarefas", icon: <ListTask size={22} /> })}
                        {renderButton({ text: "Atualidades", icon: <Newspaper size={22} /> })}
                        {renderButton({ text: "Calendário", icon: <Calendar size={22} /> })}
                    </Stack>

                    <Stack className="mt-5">
                        {renderButton({ text: "Contate-nos", icon: <InfoCircle size={22}></InfoCircle> })}
                    </Stack>
                </div>
            </Stack>
        </div>
    );

    function renderButton({ text, icon }: MenuButtonProps) {
        return (
            <Button variant="">
                <div style={{ display: "flex", alignItems: "center", justifyContent: "start" }}>
                    {icon}
                    <span style={{ marginLeft: "8px", textAlign: "left" }}>{text}</span>
                </div>
            </Button>
        );
    }
}
