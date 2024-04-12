using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("entregue")]
    public class TarefaEntregue
    {
    
        //tabela que guarda qual aluno entregou qual tarefa

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

        public void Update(int idAluno, int idTarefa, string comentariosProfessor, string comentariosAluno)
        {
            IdAluno = idAluno;
            IdTarefa = idTarefa;
            ComentariosAluno = comentariosAluno;
            ComentariosProfessor = comentariosProfessor;
        }
    }
}
