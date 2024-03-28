using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("turmaProfessor")]
    public class TurmaProfessor
    {
        [Key]
        public int Id { get; set; }

        // Propriedades de chave estrangeira
        public int TurmaId { get; set; }
        public Turma Turma { get; set; }

        public int ProfessorId { get; set; }
        public Professor Professor { get; set; }
    }
}
