using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("entregue")]
    public class Entregue
    {
    

        public int Id { get; set; }
        [ForeignKey("Aluno")]
        public int IdAluno { get; set; }
        public Aluno Aluno { get; set; }

        [ForeignKey("Tarefa")]
        public int IdTarefa { get; set; }
        public Tarefa Tarefa { get; set; }

        public DateTime DataEntregue { get; set; }
        public string ComentariosProfessor { get; set; }
        public string ComentariosAluno { get; set; }

    }
}
