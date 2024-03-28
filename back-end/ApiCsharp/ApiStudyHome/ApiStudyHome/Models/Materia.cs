using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("materia")]
    public class Materia
    {
        public Materia(string nome)
        {
            Nome = nome;
        }

        public int Id { get; set; }
        public string Nome { get; set; }

    }
}
