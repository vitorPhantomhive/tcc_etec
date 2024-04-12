using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("tarefa")]
    public class Tarefa
    {
      


        public int Id { get; set; }
        public string Nome { get; set; }
        public string Descricao { get; set; }
        public DateTime DataCadastro {  get; set; }
        public DateTime DataFinal{  get; set; }
        public string NomeArquivo { get; set; }
        public string Materia { get; set; }
        public bool Ativo {  get; set; }

        [ForeignKey("Professor")]
        public int ProfessorId { get; set; }
        public Professor Professor { get; set; }

        public ICollection<TarefaEntregue> Entregas { get; set; }



    }
}
