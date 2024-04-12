using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("arquivoEntregue")]
    //tabela que serve para dizer qual aluno entregou essa atividade
    public class ArquivoEntregue
    {
        public int Id { get; set; }
        //é o proprio arquivo entregue da atividade
        public string Nome { get; set; }

        [ForeignKey("Aluno")]
        public int AlunoId { get; set; }
        public Aluno Aluno { get; set; }

        [ForeignKey("Tarefa")]
        public int TarefaId { get; set; }
        public Tarefa Tarefa { get; set; }
    }
}
