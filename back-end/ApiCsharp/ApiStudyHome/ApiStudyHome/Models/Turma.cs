using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("turma")]
    public class Turma
    {

        public int Id { get; set; }
        public string Nome { get; set; }

        public ICollection<TurmaProfessor> Professores { get; set; }
        public ICollection<Aluno> Alunos { get; set; }
        public ICollection<Tarefa> Tarefas { get; set; }

        public void Update(int id, string nome)
        {
            Id = id;
            Nome = nome;

        }
    }
}
